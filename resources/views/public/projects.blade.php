<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Semua Project - {{ $home->site_name ?? 'Portofolio' }}</title>
    
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
        
        /* Animasi Filter Project */
        .project-card { transition: all 0.4s ease-in-out; }
        .project-hidden { opacity: 0; transform: scale(0.95); pointer-events: none; position: absolute; visibility: hidden; }
        
        /* Mobile Menu */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="fixed w-full top-0 z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl md:text-2xl font-bold text-dynamic tracking-tight hover:opacity-80 transition z-50 relative">
                    {{ $home->site_name ?? 'Portfolio' }}
                </a>
                
                <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-gray-600">
                    <a href="{{ route('home') }}" class="hover-text-dynamic transition duration-200">Home</a>
                    <a href="{{ route('public.services') }}" class="hover-text-dynamic transition duration-200">Services</a>
                    <a href="{{ route('home') }}#contact" class="px-5 py-2.5 rounded-full bg-gray-900 text-white hover-bg-dynamic transition duration-200 shadow-md transform hover:-translate-y-0.5">Hubungi Saya</a>
                </div>
                
                <div class="md:hidden flex items-center z-50 relative">
                    <button id="mobile-menu-btn" class="outline-none p-2 rounded-xl bg-gray-50 border border-gray-100 text-gray-700 hover:bg-gray-100 transition focus:ring-2 focus:ring-gray-200">
                        <svg id="icon-menu" class="w-6 h-6 transition-transform duration-300" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg id="icon-close" class="w-6 h-6 hidden transition-transform duration-300" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu-wrapper" class="fixed inset-0 top-0 pt-20 px-4 pb-4 z-40 hidden w-full h-screen bg-gray-900/20 backdrop-blur-sm transition-opacity duration-300 opacity-0">
            <div id="mobile-menu-content" class="bg-white/95 backdrop-blur-xl border border-gray-100 shadow-2xl rounded-3xl overflow-hidden transition-all duration-300 transform -translate-y-8 scale-95 opacity-0">
                <div class="flex flex-col p-4 space-y-2 font-medium text-center">
                    <a href="{{ route('home') }}" class="mobile-link block py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover-text-dynamic transition">Home</a>
                    <a href="{{ route('public.services') }}" class="mobile-link block py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover-text-dynamic transition">Services</a>
                    <div class="pt-2">
                        <a href="{{ route('home') }}#contact" class="mobile-link block py-3.5 rounded-xl bg-gray-900 text-white hover-bg-dynamic transition shadow-lg w-full">Hubungi Saya</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-28 md:pt-36 pb-10 md:pb-12 px-6 text-center bg-white border-b border-gray-100 relative overflow-hidden">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-dynamic opacity-5 rounded-full blur-3xl -z-10"></div>
        <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4 tracking-tight">Semua Project</h1>
        <p class="text-gray-500 text-sm md:text-base max-w-2xl mx-auto">Koleksi lengkap karya dan studi kasus yang telah saya kerjakan.</p>
    </div>

    <section class="py-12 md:py-20 bg-gray-50 flex-grow relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @php
                $allTechs = [];
                if(isset($projects)) {
                    foreach($projects as $p) {
                        if(!empty($p->tech_stack)) {
                            $techs = explode(',', $p->tech_stack);
                            foreach($techs as $t) {
                                $cleanTech = trim($t);
                                if($cleanTech != '') {
                                    $allTechs[] = ucwords(strtolower($cleanTech));
                                }
                            }
                        }
                    }
                }
                $filterTechs = array_values(array_unique($allTechs));
            @endphp

            @if(count($filterTechs) > 0)
            <div class="flex flex-wrap justify-center gap-2 sm:gap-3 mb-10 md:mb-12 relative z-20" id="filter-container">
                <button class="filter-btn active px-4 sm:px-5 py-2 sm:py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 bg-dynamic text-white shadow-lg shadow-indigo-500/30 transform hover:-translate-y-0.5" data-filter="all">
                    Semua
                </button>
                @foreach($filterTechs as $ft)
                    <button class="filter-btn px-4 sm:px-5 py-2 sm:py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 bg-white text-gray-600 hover:bg-gray-100 hover:text-gray-900 border border-gray-200 transform hover:-translate-y-0.5 shadow-sm" data-filter="{{ strtolower($ft) }}">
                        {{ $ft }}
                    </button>
                @endforeach
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8" id="project-grid">
                @forelse($projects as $project)
                <div class="project-card relative group bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden flex flex-col h-full border border-gray-100" data-category="{{ strtolower($project->tech_stack) }}">
                    
                    <div class="relative h-48 md:h-56 overflow-hidden bg-gray-200">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition z-10"></div>
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    </div>

                    <div class="p-6 md:p-8 flex flex-col flex-1">
                        <div class="mb-4 flex flex-wrap gap-1.5">
                            @foreach(explode(',', $project->tech_stack) as $tech)
                                <span class="px-2.5 py-1 text-[9px] md:text-[10px] font-bold uppercase tracking-wider rounded-md bg-gray-50 text-gray-600 border border-gray-200">
                                    {{ trim($tech) }}
                                </span>
                            @endforeach
                        </div>

                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 group-hover-text-dynamic transition">
                            <a href="{{ route('project.show', $project->id) }}" class="focus:outline-none">
                                <span class="absolute inset-0 z-0"></span>
                                {{ $project->title }}
                            </a>
                        </h3>

                        <p class="text-gray-600 text-xs md:text-sm mb-6 line-clamp-3 leading-relaxed flex-1">
                            {{ $project->description }}
                        </p>
                        
                        <div class="mt-auto pt-5 border-t border-gray-100 flex justify-between items-center z-20 relative">
                            @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" class="text-xs md:text-sm font-semibold text-gray-500 hover-text-dynamic flex items-center gap-1 transition">
                                    <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg> 
                                    Live Demo
                                </a>
                            @else
                                <span></span>
                            @endif

                            <a href="{{ route('project.show', $project->id) }}" class="text-xs md:text-sm font-bold flex items-center gap-1 group-hover:gap-2 transition-all text-dynamic">
                                Detail <span class="text-base md:text-lg leading-none">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-3 text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
                    <p class="text-gray-500">Belum ada project yang ditambahkan.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-12 md:mt-16 flex justify-center">
                {{ $projects->links() }}
            </div>

        </div>
    </section>

    <footer class="bg-white border-t border-gray-100 py-10 md:py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center justify-center text-center">
            <span class="font-bold text-lg md:text-xl tracking-tight text-gray-900 block">{{ $home->site_name ?? 'Portfolio' }}</span>
            <p class="text-gray-400 text-xs md:text-sm mt-1.5 md:mt-2">{{ $home->footer_text ?? '© ' . date('Y') . '. All rights reserved.' }}</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Mobile Menu Logic
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
            wrapper.addEventListener('click', (e) => { if (e.target === wrapper) toggleMenu(); });
            links.forEach(link => { link.addEventListener('click', toggleMenu); });

            // 2. Project Filter Logic
            const filterBtns = document.querySelectorAll('.filter-btn');
            const projectCards = document.querySelectorAll('.project-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Update Active Style
                    filterBtns.forEach(b => {
                        b.classList.remove('bg-dynamic', 'text-white', 'shadow-lg', 'shadow-indigo-500/30');
                        b.classList.add('bg-white', 'text-gray-600', 'border');
                    });
                    btn.classList.remove('bg-white', 'text-gray-600', 'border');
                    btn.classList.add('bg-dynamic', 'text-white', 'shadow-lg', 'shadow-indigo-500/30');

                    const filterValue = btn.getAttribute('data-filter');

                    // Filter Cards
                    projectCards.forEach(card => {
                        const categories = card.getAttribute('data-category');
                        
                        if (filterValue === 'all' || categories.includes(filterValue)) {
                            card.classList.remove('project-hidden');
                            setTimeout(() => { card.style.display = 'flex'; }, 50);
                        } else {
                            card.classList.add('project-hidden');
                            setTimeout(() => { 
                                if(card.classList.contains('project-hidden')) {
                                    card.style.display = 'none'; 
                                }
                            }, 300);
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>