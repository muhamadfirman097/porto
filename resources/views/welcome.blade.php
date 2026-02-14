<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    
    <title>{{ $home->site_name ?? 'Portofolio' }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: {{ $home->primary_color ?? '#4f46e5' }};
            --primary-light: {{ $home->primary_color ?? '#4f46e5' }}15; 
        }
        body { font-family: 'Figtree', sans-serif; }
        .text-dynamic { color: var(--primary-color); }
        .bg-dynamic { background-color: var(--primary-color); }
        .bg-dynamic-light { background-color: var(--primary-light); }
        .border-dynamic { border-color: var(--primary-color); }
        .hover-bg-dynamic:hover { background-color: var(--primary-color); }
        .hover-text-dynamic:hover { color: var(--primary-color); }
        .hover-border-dynamic:hover { border-color: var(--primary-color); }
        .focus-ring-dynamic:focus { --tw-ring-color: var(--primary-color); --tw-ring-opacity: 0.5; }
        .shadow-glow { box-shadow: 0 0 40px -5px var(--primary-color); }
        .progress-bar { transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        .project-card { transition: all 0.4s ease-in-out; }
        .project-hidden { opacity: 0; transform: scale(0.95); pointer-events: none; position: absolute; visibility: hidden; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="fixed w-full top-0 z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <a href="#" class="text-xl md:text-2xl font-bold text-dynamic tracking-tight hover:opacity-80 transition z-50 relative">
                    {{ $home->site_name ?? 'Portfolio' }}
                </a>
                
                <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-gray-600">
                    <a href="#about" class="hover-text-dynamic transition duration-200">About</a>
                    <a href="#skills" class="hover-text-dynamic transition duration-200">Skills</a>
                    <a href="#services" class="hover-text-dynamic transition duration-200">Services</a>
                    <a href="#projects" class="hover-text-dynamic transition duration-200">Projects</a>
                    <a href="#contact" class="px-5 py-2.5 rounded-full bg-gray-900 text-white hover-bg-dynamic transition duration-200 shadow-md transform hover:-translate-y-0.5">Hubungi Saya</a>
                </div>
                
                <div class="md:hidden flex items-center z-50 relative">
                    <button id="mobile-menu-btn" class="outline-none p-2 rounded-xl bg-gray-50 border border-gray-100 text-gray-700 hover:bg-gray-100 transition focus:ring-2 focus:ring-gray-200">
                        <svg id="icon-menu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu-wrapper" class="fixed inset-0 top-0 pt-20 px-4 pb-4 z-40 hidden w-full h-screen bg-gray-900/20 backdrop-blur-sm transition-opacity duration-300 opacity-0">
            <div id="mobile-menu-content" class="bg-white/95 backdrop-blur-xl border border-gray-100 shadow-2xl rounded-3xl overflow-hidden transition-all duration-300 transform -translate-y-8 scale-95 opacity-0">
                <div class="flex flex-col p-4 space-y-2 font-medium text-center">
                    <a href="#about" class="mobile-link block py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover-text-dynamic transition">About</a>
                    <a href="#skills" class="mobile-link block py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover-text-dynamic transition">Skills</a>
                    <a href="#services" class="mobile-link block py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover-text-dynamic transition">Services</a>
                    <a href="#projects" class="mobile-link block py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover-text-dynamic transition">Projects</a>
                    <div class="pt-2">
                        <a href="#contact" class="mobile-link block py-3.5 rounded-xl bg-gray-900 text-white hover-bg-dynamic transition shadow-lg w-full">Hubungi Saya</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section id="about" class="pt-32 pb-16 md:pt-40 md:pb-32 px-6 max-w-7xl mx-auto flex flex-col-reverse md:flex-row items-center justify-between gap-12 bg-white relative">
        <div class="w-full md:w-1/2 space-y-6 md:space-y-8 text-center md:text-left animate-fade-in-up">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold bg-dynamic-light text-dynamic">
                👋 Halo, Saya Web Developer
            </span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 leading-tight tracking-tight">
                {{ $home->hero_title ?? 'Selamat Datang' }}
            </h1>
            <p class="text-base sm:text-lg text-gray-600 leading-relaxed max-w-lg mx-auto md:mx-0">
                {{ $home->hero_description ?? 'Deskripsi singkat tentang diri Anda akan muncul di sini.' }}
            </p>
            <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4 justify-center md:justify-start pt-2">
                <a href="#projects" class="w-full sm:w-auto px-8 py-3.5 sm:py-4 bg-dynamic text-white rounded-xl font-bold shadow-lg shadow-indigo-500/20 hover:shadow-xl hover:opacity-90 transition transform hover:-translate-y-1 text-center">
                    Lihat Portfolio
                </a>
                
                @if(isset($home->cv_file) && $home->cv_file)
                <a href="{{ asset('storage/' . $home->cv_file) }}" target="_blank" class="w-full sm:w-auto px-6 py-3.5 sm:py-4 bg-gray-900 text-white rounded-xl font-bold shadow-lg hover:shadow-xl hover:bg-gray-800 transition transform hover:-translate-y-1 text-center flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download CV
                </a>
                @endif

                <a href="#contact" class="w-full sm:w-auto px-8 py-3.5 sm:py-4 bg-white text-gray-700 border border-gray-200 rounded-xl font-bold hover:border-dynamic hover-text-dynamic transition shadow-sm hover:shadow-md text-center">
                    Hubungi Saya
                </a>
            </div>
        </div>
        
        <div class="w-full md:w-1/2 flex justify-center md:justify-end relative mt-8 md:mt-0">
            <div class="absolute top-1/2 right-1/2 transform translate-x-1/2 -translate-y-1/2 w-56 h-56 sm:w-72 sm:h-72 bg-dynamic opacity-20 md:opacity-30 rounded-full blur-3xl -z-10 animate-pulse"></div>
            <div class="relative w-56 h-56 sm:w-64 sm:h-64 md:w-80 md:h-80 lg:w-96 lg:h-96 rounded-full p-2 sm:p-3 border-2 border-dashed border-dynamic/40">
                <div class="w-full h-full rounded-full overflow-hidden shadow-glow relative z-10 bg-gray-100 border-4 border-white"> 
                    @if(isset($home->profile_image) && $home->profile_image)
                        <img src="{{ str_contains($home->profile_image, 'http') ? $home->profile_image : asset('storage/' . $home->profile_image) }}" alt="Profile" class="object-cover w-full h-full hover:scale-110 transition duration-700">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($home->site_name ?? 'User') }}&background=random&size=512" class="object-cover w-full h-full">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section id="skills" class="py-20 md:py-24 bg-white relative overflow-hidden border-t border-gray-100">
        <div class="max-w-5xl mx-auto px-6 relative z-10">
            <div class="text-center mb-10 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Keahlian Teknis</h2>
                <div class="w-16 md:w-20 h-1.5 bg-dynamic mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 sm:gap-6">
                @forelse($skills ?? [] as $skill)
                <div class="group bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 flex flex-col items-center justify-center text-center hover:[border-color:var(--primary-color)]">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-xl bg-gray-50 flex items-center justify-center p-3 mb-3 transition-colors duration-300 group-hover:[background-color:var(--primary-light)]">
                        @if($skill->image)
                            <img src="{{ str_contains($skill->image, 'http') ? $skill->image : asset('storage/' . $skill->image) }}" alt="{{ $skill->name }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300">
                        @else
                            <span class="text-2xl font-bold text-gray-400 transition group-hover:[color:var(--primary-color)]">{{ substr($skill->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <h4 class="text-sm sm:text-base font-bold text-gray-800 mb-1.5 transition group-hover:[color:var(--primary-color)]">{{ $skill->name }}</h4>
                    <span class="px-3 py-1 text-[10px] sm:text-xs font-bold rounded-full bg-gray-100 text-gray-500 transition-colors duration-300 group-hover:[background-color:var(--primary-color)] group-hover:text-white">
                        {{ $skill->percentage }}%
                    </span>
                </div>
                @empty
                <div class="col-span-full text-center py-10 text-gray-400 italic bg-gray-50 rounded-2xl border border-dashed border-gray-200">Belum ada skill yang ditambahkan.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="services" class="py-20 md:py-24 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Layanan Saya</h2>
                <div class="w-16 md:w-20 h-1.5 bg-dynamic mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($services ?? [] as $service)
                <div class="bg-white rounded-3xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 hover:-translate-y-1 group overflow-hidden flex flex-col h-full">
                    <div class="h-40 md:h-48 overflow-hidden relative bg-gray-100">
                        @if($service->image)
                            <img src="{{ str_contains($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="flex items-center justify-center h-full bg-dynamic-light text-dynamic">
                                <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 md:p-8 flex flex-col flex-1">
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3 group-hover-text-dynamic transition">{{ $service->title }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed flex-1 line-clamp-4">{{ $service->description }}</p>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-3 text-center py-12 text-gray-400 italic bg-white rounded-2xl border border-dashed border-gray-200">Belum ada layanan yang ditambahkan.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="projects" class="py-20 md:py-24 bg-white border-t border-gray-100 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-10 md:mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Project Terbaru</h2>
                <div class="w-16 md:w-20 h-1.5 bg-dynamic mx-auto rounded-full mb-6"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8" id="project-grid">
                @forelse($projects ?? [] as $project)
                <div class="project-card relative group bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden flex flex-col border border-gray-100" data-category="{{ strtolower($project->tech_stack) }}">
                    <div class="relative h-48 md:h-56 overflow-hidden bg-gray-200">
                        <img src="{{ str_contains($project->image, 'http') ? $project->image : asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    </div>
                    
                    <div class="p-6 md:p-8 flex flex-col flex-1">
                        <div class="mb-4 flex flex-wrap gap-1.5">
                            @foreach(explode(',', $project->tech_stack) as $tech)
                                <span class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider rounded-md bg-gray-50 text-gray-600 border border-gray-200">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 group-hover-text-dynamic transition">{{ $project->title }}</h3>
                        <p class="text-gray-600 text-xs md:text-sm mb-6 line-clamp-3 leading-relaxed flex-1">{{ $project->description }}</p>
                        
                        <div class="mt-auto pt-5 border-t border-gray-100 flex justify-between items-center">
                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" class="text-xs md:text-sm font-semibold text-gray-500 hover-text-dynamic flex items-center gap-1 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg> 
                                    Live Demo
                                </a>
                            @endif
                            <a href="{{ route('project.show', $project->id) }}" class="text-xs md:text-sm font-bold text-dynamic">Detail &rarr;</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-20 bg-gray-50 rounded-3xl border border-dashed border-gray-300">Belum ada project.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="contact" class="py-20 md:py-24 bg-gray-50 border-t border-gray-100">
        </section>

    <footer class="bg-white border-t border-gray-100 py-10 mt-auto">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <span class="font-bold text-lg text-gray-900">{{ $home->site_name ?? 'Portfolio' }}</span>
                <p class="text-gray-400 text-xs mt-2">{{ $home->footer_text ?? '© ' . date('Y') . '. All rights reserved.' }}</p>
            </div>
            <div class="flex gap-6">
                <a href="#about" class="text-xs font-medium text-gray-500 hover-text-dynamic transition">Home</a>
                <a href="#services" class="text-xs font-medium text-gray-500 hover-text-dynamic transition">Services</a>
                <a href="#projects" class="text-xs font-medium text-gray-500 hover-text-dynamic transition">Works</a>
                <a href="#contact" class="text-xs font-medium text-gray-500 hover-text-dynamic transition">Contact</a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const wrapper = document.getElementById('mobile-menu-wrapper');
            const content = document.getElementById('mobile-menu-content');
            const iconMenu = document.getElementById('icon-menu');
            const iconClose = document.getElementById('icon-close');
            const links = document.querySelectorAll('.mobile-link');

            function toggleMenu() {
                const isHidden = wrapper.classList.contains('hidden');
                if (isHidden) {
                    wrapper.classList.remove('hidden');
                    iconMenu.classList.add('hidden');
                    iconClose.classList.remove('hidden');
                    setTimeout(() => {
                        wrapper.classList.remove('opacity-0');
                        content.classList.remove('opacity-0', '-translate-y-8', 'scale-95');
                        content.classList.add('opacity-100', 'translate-y-0', 'scale-100');
                    }, 10);
                } else {
                    wrapper.classList.add('opacity-0');
                    content.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
                    content.classList.add('opacity-0', '-translate-y-8', 'scale-95');
                    iconMenu.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                    setTimeout(() => { wrapper.classList.add('hidden'); }, 300);
                }
            }

            btn.addEventListener('click', toggleMenu);
            links.forEach(link => { link.addEventListener('click', toggleMenu); });
        });
    </script>
</body>
</html>
