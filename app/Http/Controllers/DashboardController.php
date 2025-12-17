<?php

namespace App\Http\Controllers;

use App\Models\AuditProgram;
use App\Models\AuditQuestion;
use App\Models\AuditTimeline;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role->name;
        $currentYear = date('Y');

        $data = [];

        if ($role === 'admin') {
            $data = $this->getAdminDashboardData($currentYear);
        } elseif ($role === 'auditor') {
            $data = $this->getAuditorDashboardData($currentYear);
        } elseif (in_array($role, ['auditee_sm', 'auditee_em'])) {
            $data = $this->getAuditeeDashboardData($user, $currentYear);
        } else { // pimpinan
            $data = $this->getPimpinanDashboardData($currentYear);
        }

        return view('dashboard', $data);
    }

    private function getAdminDashboardData($year)
    {
        return [
            'totalDepartments' => Department::count(),
            'totalUsers' => User::count(),
            'activeDepartments' => Department::where('is_active', true)->count(),
            'seniorManagers' => User::where('is_department_head', true)->count(),
            'timelinesThisYear' => AuditTimeline::where('audit_year', $year)->count(),
            'activePrograms' => AuditProgram::where('status', 'active')->count(),
            'recentDepartments' => Department::with('seniorManager')
                ->latest()
                ->take(5)
                ->get(),
            'recentUsers' => User::with('role', 'department')
                ->latest()
                ->take(5)
                ->get(),
        ];
    }

    private function getAuditorDashboardData($year)
    {
        $activeTimelines = AuditTimeline::where('audit_year', $year)
            ->where('status', 'active')
            ->count();

        $activePrograms = AuditProgram::where('status', 'active')->count();
        $draftPrograms = AuditProgram::where('status', 'draft')->count();
        $completedPrograms = AuditProgram::where('status', 'completed')->count();

        // Questions needing review (in_progress status)
        $questionsNeedReview = AuditQuestion::where('status', 'in_progress')->count();

        // Get all timelines for current year for Gantt Chart and Calendar View
        $timelines = AuditTimeline::with('department')
            ->where('audit_year', $year)
            ->orderBy('start_date')
            ->get();

        // Recent programs
        $recentPrograms = AuditProgram::with(['auditTimeline.department', 'createdBy'])
            ->latest()
            ->take(5)
            ->get();

        // Progress by department
        $departmentProgress = AuditProgram::with('auditTimeline.department')
            ->select('audit_timeline_id', 
                DB::raw('SUM(total_questions) as total_questions'),
                DB::raw('SUM(closed_questions) as closed_questions'))
            ->groupBy('audit_timeline_id')
            ->get()
            ->map(function($program) {
                $percentage = $program->total_questions > 0 
                    ? round(($program->closed_questions / $program->total_questions) * 100) 
                    : 0;
                return [
                    'department' => $program->auditTimeline->department->name ?? 'N/A',
                    'total' => $program->total_questions,
                    'closed' => $program->closed_questions,
                    'percentage' => $percentage
                ];
            });

        // Monthly audit statistics (last 6 months)
        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthKey = $month->format('Y-m');
            
            $created = AuditProgram::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            
            $completed = AuditProgram::where('status', 'completed')
                ->whereYear('updated_at', $month->year)
                ->whereMonth('updated_at', $month->month)
                ->count();
            
            $monthlyStats[] = [
                'month' => $month->format('M'),
                'created' => $created,
                'completed' => $completed,
            ];
        }

        // Question status distribution for chart
        $totalQuestions = AuditQuestion::count();
        $openQuestions = AuditQuestion::where('status', 'open')->count();
        $inProgressQuestions = AuditQuestion::where('status', 'in_progress')->count();
        $closedQuestions = AuditQuestion::where('status', 'closed')->count();

        $questionDistribution = [
            'open' => $totalQuestions > 0 ? round(($openQuestions / $totalQuestions) * 100) : 0,
            'in_progress' => $totalQuestions > 0 ? round(($inProgressQuestions / $totalQuestions) * 100) : 0,
            'closed' => $totalQuestions > 0 ? round(($closedQuestions / $totalQuestions) * 100) : 0,
        ];

        return [
            'activeTimelines' => $activeTimelines,
            'activePrograms' => $activePrograms,
            'draftPrograms' => $draftPrograms,
            'completedPrograms' => $completedPrograms,
            'questionsNeedReview' => $questionsNeedReview,
            'recentPrograms' => $recentPrograms,
            'departmentProgress' => $departmentProgress,
            'totalQuestions' => $totalQuestions,
            'openQuestions' => $openQuestions,
            'inProgressQuestions' => $inProgressQuestions,
            'closedQuestions' => $closedQuestions,
            'monthlyStats' => $monthlyStats,
            'questionDistribution' => $questionDistribution,
            'timelines' => $timelines,
            'year' => $year,
        ];
    }

    private function getAuditeeDashboardData($user, $year)
    {
        $department = $user->department;
        
        if (!$department) {
            return [
                'hasAudit' => false,
                'message' => 'Anda belum terdaftar di departemen manapun'
            ];
        }

        // Get active timeline for this department
        $activeTimeline = AuditTimeline::where('department_id', $department->id)
            ->where('audit_year', $year)
            ->where('status', 'active')
            ->first();

        if (!$activeTimeline) {
            return [
                'hasAudit' => false,
                'department' => $department,
                'message' => 'Belum ada audit yang dijadwalkan untuk departemen Anda'
            ];
        }

        // Get program for this timeline
        $program = AuditProgram::where('audit_timeline_id', $activeTimeline->id)->first();

        if (!$program) {
            return [
                'hasAudit' => false,
                'department' => $department,
                'timeline' => $activeTimeline,
                'message' => 'Program audit belum dibuat'
            ];
        }

        // Get questions statistics
        $totalQuestions = $program->total_questions;
        $openQuestions = AuditQuestion::where('audit_program_id', $program->id)
            ->where('status', 'open')
            ->count();
        $inProgressQuestions = AuditQuestion::where('audit_program_id', $program->id)
            ->where('status', 'in_progress')
            ->count();
        $closedQuestions = $program->closed_questions;

        $percentage = $totalQuestions > 0 
            ? round(($closedQuestions / $totalQuestions) * 100) 
            : 0;

        return [
            'hasAudit' => true,
            'department' => $department,
            'timeline' => $activeTimeline,
            'program' => $program,
            'totalQuestions' => $totalQuestions,
            'openQuestions' => $openQuestions,
            'inProgressQuestions' => $inProgressQuestions,
            'closedQuestions' => $closedQuestions,
            'percentage' => $percentage,
        ];
    }

    private function getPimpinanDashboardData($year)
    {
        $totalDepartments = Department::count();
        $auditsThisYear = AuditTimeline::where('audit_year', $year)->count();
        $completedAudits = AuditProgram::where('status', 'completed')->count();
        
        // Get all programs with progress
        $programsOverview = AuditProgram::with('auditTimeline.department')
            ->where('status', '!=', 'draft')
            ->get()
            ->map(function($program) {
                $percentage = $program->total_questions > 0 
                    ? round(($program->closed_questions / $program->total_questions) * 100) 
                    : 0;
                return [
                    'department' => $program->auditTimeline->department->name,
                    'program_name' => $program->program_name,
                    'status' => $program->status,
                    'percentage' => $percentage,
                    'total_questions' => $program->total_questions,
                    'closed_questions' => $program->closed_questions,
                ];
            });

        return [
            'totalDepartments' => $totalDepartments,
            'auditsThisYear' => $auditsThisYear,
            'completedAudits' => $completedAudits,
            'activeAudits' => AuditProgram::where('status', 'active')->count(),
            'programsOverview' => $programsOverview,
            'totalQuestions' => AuditQuestion::count(),
            'closedQuestions' => AuditQuestion::where('status', 'closed')->count(),
        ];
    }
}
