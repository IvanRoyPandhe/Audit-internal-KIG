<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RkiaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // RKIA Routes - Year Selection (Entry Point)
    Route::get('/rkia/program', [RkiaController::class, 'yearSelection'])->name('rkia.program');
    Route::get('/rkia/program/{year}', [RkiaController::class, 'programByYear'])->name('rkia.program.year');
    
    // Audit Year Management (Admin only)
    Route::post('/audit-years', [\App\Http\Controllers\AuditYearController::class, 'store'])->name('audit-years.store');
    Route::delete('/audit-years/{auditYear}', [\App\Http\Controllers\AuditYearController::class, 'destroy'])->name('audit-years.destroy');
    Route::patch('/audit-years/{auditYear}/toggle', [\App\Http\Controllers\AuditYearController::class, 'toggleActive'])->name('audit-years.toggle');
    
    // Timeline Routes (with year context)
    Route::get('/rkia/{year}/timeline', [RkiaController::class, 'timeline'])->name('rkia.timeline');
    Route::get('/rkia/{year}/timeline/create', [RkiaController::class, 'createTimeline'])->name('rkia.timeline.create');
    Route::post('/rkia/{year}/timeline', [RkiaController::class, 'storeTimeline'])->name('rkia.timeline.store');
    Route::get('/rkia/{year}/timeline/{timeline}/edit', [RkiaController::class, 'editTimeline'])->name('rkia.timeline.edit');
    Route::put('/rkia/{year}/timeline/{timeline}', [RkiaController::class, 'updateTimeline'])->name('rkia.timeline.update');
    Route::delete('/rkia/{year}/timeline/{timeline}', [RkiaController::class, 'destroyTimeline'])->name('rkia.timeline.destroy');
    Route::get('/rkia/{year}/timeline/download-template', [RkiaController::class, 'downloadTemplate'])->name('rkia.timeline.download-template');
    Route::post('/rkia/{year}/timeline/import', [RkiaController::class, 'importTimeline'])->name('rkia.timeline.import');
    
    // Program Audit List (with year context)
    Route::get('/rkia/{year}/program-list', [RkiaController::class, 'programList'])->name('rkia.program-list');
    
    // Audit Program Routes
    Route::get('/audit-programs/create/{timeline}', [\App\Http\Controllers\AuditProgramController::class, 'create'])->name('audit-programs.create');
    Route::post('/audit-programs/{timeline}', [\App\Http\Controllers\AuditProgramController::class, 'store'])->name('audit-programs.store');
    Route::get('/audit-programs/{program}', [\App\Http\Controllers\AuditProgramController::class, 'show'])->name('audit-programs.show');
    Route::put('/audit-programs/{program}', [\App\Http\Controllers\AuditProgramController::class, 'update'])->name('audit-programs.update');
    Route::delete('/audit-programs/{program}', [\App\Http\Controllers\AuditProgramController::class, 'destroy'])->name('audit-programs.destroy');

    // Audit Program Document Routes
    Route::post('/audit-programs/{program}/documents', [\App\Http\Controllers\AuditProgramDocumentController::class, 'store'])->name('audit-program-documents.store');
    Route::post('/audit-program-documents/{document}/upload', [\App\Http\Controllers\AuditProgramDocumentController::class, 'upload'])->name('audit-program-documents.upload');
    Route::get('/audit-program-documents/{document}/download', [\App\Http\Controllers\AuditProgramDocumentController::class, 'download'])->name('audit-program-documents.download');
    Route::delete('/audit-program-documents/{document}', [\App\Http\Controllers\AuditProgramDocumentController::class, 'destroy'])->name('audit-program-documents.destroy');

    // Audit Question Routes
    Route::get('/audit-questions/{question}', [\App\Http\Controllers\AuditQuestionController::class, 'show'])->name('audit-questions.show');
    Route::post('/audit-programs/{program}/questions', [\App\Http\Controllers\AuditQuestionController::class, 'store'])->name('audit-questions.store');
    Route::put('/audit-questions/{question}', [\App\Http\Controllers\AuditQuestionController::class, 'update'])->name('audit-questions.update');
    Route::patch('/audit-questions/{question}/status', [\App\Http\Controllers\AuditQuestionController::class, 'updateStatus'])->name('audit-questions.update-status');
    Route::delete('/audit-questions/{question}', [\App\Http\Controllers\AuditQuestionController::class, 'destroy'])->name('audit-questions.destroy');
    
    // Question Comments Routes
    Route::post('/audit-questions/{question}/comments', [\App\Http\Controllers\AuditQuestionController::class, 'addComment'])->name('audit-questions.add-comment');
    Route::delete('/question-comments/{comment}', [\App\Http\Controllers\AuditQuestionController::class, 'deleteComment'])->name('audit-questions.delete-comment');

    // Laporan Routes
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // Department Management Routes (Admin only)
    Route::middleware(['auth'])->group(function () {
        Route::resource('departments', DepartmentController::class);
        Route::post('departments/{department}/assign-users', [DepartmentController::class, 'assignUsers'])->name('departments.assign-users');
    });

    // User Management Routes
    Route::resource('users', UserController::class);

    // Role Management Routes
    Route::resource('roles', RoleController::class);

    // Karyawan Routes (alias untuk users dengan view berbeda)
    Route::get('/karyawan', [UserController::class, 'karyawan'])->name('karyawan.index');
    
    // Auditee Routes
    Route::get('/auditee/dashboard', function () {
        return view('auditee.dashboard');
    })->name('auditee.dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
