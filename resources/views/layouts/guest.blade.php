<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                background: linear-gradient(135deg, #e0e7ff 0%, #f0f4ff 100%);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden flex">
                <!-- Left Side - Blue Panel -->
                <div class="hidden lg:flex lg:w-1/2 bg-blue-600 text-white p-12 flex-col justify-center">
                    <div class="mb-8 flex justify-center">
                        <img src="{{ asset('storage/logo-kig.png') }}" alt="Logo KIG" class="w-24 h-24 object-contain">
                    </div>
                    
                    <h1 class="text-4xl font-bold mb-4 text-center">KIG</h1>
                    <p class="text-xl mb-2 text-center">Sistem Informasi Audit</p>
                    
                    <h2 class="text-2xl font-semibold mt-8 mb-4 text-center">Selamat Datang</h2>
                    <p class="text-center mb-8 text-blue-100">
                        Akses portal audit Anda untuk mengelola data audit, laporan, temuan, dan informasi audit lainnya dengan mudah dan aman.
                    </p>
                    
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Manajemen Data Audit</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Jadwal Audit Real-time</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Monitoring Temuan & Laporan</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span>Notifikasi Audit</span>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="w-full lg:w-1/2 p-8 lg:p-12">
                    {{ $slot }}
                </div>
            </div>
        </div>
        
        <footer class="fixed bottom-4 w-full text-center text-sm text-gray-600">
            © {{ date('Y') }} KIG - Sistem Informasi Audit. All rights reserved.
        </footer>
    </body>
</html>
