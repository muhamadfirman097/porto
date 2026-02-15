<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $project->title }} - {{ $home->site_name }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: {{ $home->primary_color ?? '#4f46e5' }};
            --primary-light: {{ $home->primary_color ?? '#4f46e5' }}10; /* Opacity 10% */
        }
        
        body {
            font-family: 'Figtree', sans-serif;
        }

        /* Kelas Dinamis */
        .text-dynamic { color: var(--primary-color); }
        .bg-dynamic { background-color: var(--primary-color); }
        .bg-dynamic-light { background-color: var(--primary-light); }
        .border-dynamic { border-color: var(--primary-color); }
        
        .hover-text-dynamic:hover { color: var(--primary-color); }
        .hover-bg-dynamic:hover { background-color: var(--primary-color); }
        .hover-border-dynamic:hover { border-color: var(--primary-color); }

        /* Animasi Fade In Up */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="fixed w-full top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="group flex items-center gap-2 text-gray-500 hover-text-dynamic transition duration-200">
                <div class="p-2 rounded-full bg-gray-100 group-hover:bg-dynamic-light transition">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </div>
                <span class="font-semibold text-sm">Kembali ke Beranda</span>
            </a>

            <span class="font-bold text-lg text-dynamic hidden md:block">{{ $home->site_name }}</span>
        </div>
    </nav>

    <main class="flex-grow pt-28 pb-20 px-6">
        <div class="max-w-5xl mx-auto animate-fade-in-up">
            
            <div class="text-center max-w-3xl mx-auto mb-12">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 border border-gray-200 text-xs font-semibold text-gray-600 mb-6 uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-dynamic"></span>
                    Project Showcase
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $project->title }}
                </h1>

                <div class="flex flex-wrap justify-center gap-2">
                    @foreach(explode(',', $project->tech_stack) as $tech)
                        <span class="px-4 py-1.5 text-sm font-medium bg-white border border-gray-200 text-gray-600 rounded-full shadow-sm">
                            {{ trim($tech) }}
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="relative group mb-16">
                <div class="absolute -inset-1 bg-gradient-to-r from-gray-200 to-gray-300 rounded-[2rem] blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                
                <div class="relative w-full aspect-video bg-gray-100 rounded-[1.5rem] overflow-hidden shadow-2xl border border-gray-100">
                    <img src="{{ \Illuminate\Support\Str::startsWith($project->image, 'http') ? $project->image : asset('storage/' . $project->image) }}" 
                         alt="{{ $project->title }}" 
                         class="w-full h-full object-cover transform transition duration-700 hover:scale-105">
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <div class="lg:col-span-2">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-dynamic" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Tentang Project
                    </h3>
                    
                    <div class="prose prose-lg prose-gray max-w-none text-gray-600 leading-relaxed bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-lg sticky top-28">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Link Project</h3>
                        
                        <div class="space-y-3">
                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" class="flex items-center justify-center w-full py-3 px-4 bg-dynamic text-white font-bold rounded-xl shadow-lg shadow-indigo-500/20 hover:opacity-90 hover:-translate-y-1 transition duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    Live Demo
                                </a>
                            @endif
                            
                            @if($project->source_url)
                                <a href="{{ $project->source_url }}" target="_blank" class="flex items-center justify-center w-full py-3 px-4 bg-white border-2 border-gray-200 text-gray-700 font-bold rounded-xl hover:border-dynamic hover-text-dynamic transition duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                    Source Code
                                </a>
                            @endif
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-100 text-sm text-gray-500 space-y-2">
                            <div class="flex justify-between">
                                <span>Diupdate:</span>
                                <span class="font-medium text-gray-900">{{ $project->updated_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Status:</span>
                                <span class="font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded text-xs">Selesai</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-10 mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <span class="font-bold text-gray-900">{{ $home->site_name }}</span>
                <p class="text-gray-400 text-sm mt-1">{{ $home->footer_text }}</p>
            </div>
            <div class="flex space-x-6 text-gray-400">
                <a href="{{ route('home') }}" class="hover-text-dynamic transition">Home</a>
                <a href="{{ route('home') }}#projects" class="hover-text-dynamic transition">Projects</a>
                <a href="{{ route('home') }}#contact" class="hover-text-dynamic transition">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>