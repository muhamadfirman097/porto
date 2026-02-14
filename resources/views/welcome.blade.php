<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- PENTING: Meta tag untuk memaksa HTTPS agar style tidak berantakan di Vercel -->
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
                    <svg id="icon-menu" class="w-6 h-6 transition-transform duration-300" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    <svg id="icon-close" class="w-6 h-6 hidden transition-transform duration-300" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M6 18L18 6M6 6l12 12"></path></svg>
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
                    <!-- PERBAIKAN: Logika ImgBB untuk Foto Profil -->
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
                        <!-- PERBAIKAN: Logika ImgBB untuk Skill -->
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
                        <!-- PERBAIKAN: Logika ImgBB untuk Service -->
                        <img src="{{ str_contains($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                        <div class="flex items-center justify-center h-full bg-dynamic-light text-dynamic">
                            <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>
                    @if($service->price)
                    <div class="absolute bottom-3 left-3 md:bottom-4 md:left-4">
                        <span class="bg-white/90 backdrop-blur-sm text-gray-900 text-[10px] md:text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">{{ $service->price }}</span>
                    </div>
                    @endif
                </div>
                <div class="p-6 md:p-8 flex flex-col flex-1">
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3 group-hover-text-dynamic transition">{{ $service->title }}</h3>
                    @if($service->tech_stack)
                    <div class="flex flex-wrap gap-1.5 mb-4">
                        @foreach(explode(',', $service->tech_stack) as $tech)
                            <span class="px-2 py-0.5 text-[9px] md:text-[10px] font-bold uppercase tracking-wider rounded-md bg-gray-100 text-gray-500 border border-gray-200">{{ trim($tech) }}</span>
                        @endforeach
                    </div>
                    @endif
                    <p class="text-gray-500 text-sm leading-relaxed flex-1 line-clamp-4">{{ $service->description }}</p>
                    <div class="mt-6 pt-5 border-t border-gray-100">
                        <a href="#contact" class="text-sm font-bold text-dynamic flex items-center gap-2 hover:gap-3 transition-all">Pesan Layanan <span class="text-lg leading-none">&rarr;</span></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-3 text-center py-12 text-gray-400 italic bg-white rounded-2xl border border-dashed border-gray-200">Belum ada layanan yang ditambahkan.</div>
            @endforelse
        </div>
        
        <div class="mt-10 md:mt-12 text-center">
            <a href="{{ route('public.services') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 hover-text-dynamic transition-all duration-300">
                Lihat Semua Layanan
                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

<section id="projects" class="py-20 md:py-24 bg-white border-t border-gray-100 relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-10 md:mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Project Terbaru</h2>
            <div class="w-16 md:w-20 h-1.5 bg-dynamic mx-auto rounded-full mb-6"></div>
            <span class="text-sm text-gray-500 font-medium hidden md:block">Selected Works 2024</span>
        </div>

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
            $uniqueTechs = array_values(array_unique($allTechs));
            $filterTechs = array_slice($uniqueTechs, 0, 6); 
        @endphp

        @if(count($filterTechs) > 0)
        <div class="flex flex-wrap justify-center gap-2 sm:gap-3 mb-12 relative z-20" id="filter-container">
            <button class="filter-btn active px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 bg-dynamic text-white shadow-lg shadow-indigo-500/30 transform hover:-translate-y-0.5" data-filter="all">
                Semua
            </button>
            
            @foreach($filterTechs as $ft)
                <button class="filter-btn px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-300 bg-gray-50 text-gray-600 hover:bg-gray-100 hover:text-gray-900 border border-gray-200 transform hover:-translate-y-0.5" data-filter="{{ strtolower($ft) }}">
                    {{ $ft }}
                </button>
            @endforeach
        </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8" id="project-grid">
            @forelse($projects ?? [] as $project)
            <div class="project-card relative group bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden flex flex-col border border-gray-100" data-category="{{ strtolower($project->tech_stack) }}">
                <div class="relative h-48 md:h-56 overflow-hidden bg-gray-200">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition z-10"></div>
                    <!-- PERBAIKAN: Logika ImgBB untuk Project Image -->
                    <img src="{{ str_contains($project->image, 'http') ? $project->image : asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
                
                <div class="p-6 md:p-8 flex flex-col flex-1">
                    <div class="mb-4 flex flex-wrap gap-1.5">
                        @foreach(explode(',', $project->tech_stack) as $tech)
                            <span class="px-2.5 py-1 text-[9px] md:text-[10px] font-bold uppercase tracking-wider rounded-md bg-gray-50 text-gray-600 border border-gray-200">{{ trim($tech) }}</span>
                        @endforeach
                    </div>
                    
                    <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2 md:mb-3 group-hover-text-dynamic transition">
                        <a href="{{ route('project.show', $project->id) }}" class="focus:outline-none">
                            <span class="absolute inset-0 z-0"></span>{{ $project->title }}
                        </a>
                    </h3>
                    
                    <p class="text-gray-600 text-xs md:text-sm mb-6 line-clamp-3 leading-relaxed flex-1">{{ $project->description }}</p>
                    
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
            <div class="col-span-1 md:col-span-3 text-center py-20 bg-gray-50 rounded-3xl border border-dashed border-gray-300">
                <p class="text-gray-500 text-sm md:text-base">Belum ada project yang ditampilkan.</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-10 md:mt-12 text-center">
            <a href="{{ route('public.projects') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 hover-text-dynamic transition-all duration-300">
                Lihat Semua Project
                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- BAGIAN CONTACT TETAP SAMA -->
<section id="contact" class="py-20 md:py-24 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mulai Kolaborasi</h2>
            <div class="w-16 md:w-20 h-1.5 bg-dynamic mx-auto rounded-full"></div>
            <p class="text-sm md:text-base text-gray-600 mt-4 md:mt-6 max-w-2xl mx-auto px-4">Punya ide brilian? Hubungi saya melalui formulir di bawah ini.</p>
        </div>

        @if(session('success'))
        <div class="max-w-4xl mx-auto mb-8 md:mb-10 bg-green-50 border border-green-200 text-green-800 px-4 md:px-6 py-4 rounded-xl flex items-center shadow-sm animate-fade-in-up">
            <svg class="w-5 h-5 md:w-6 md:h-6 mr-3 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div>
                <strong class="font-bold block text-sm md:text-base">Pesan Terkirim!</strong>
                <span class="text-xs md:text-sm">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 flex flex-col md:flex-row">
            
            <div class="w-full md:w-2/5 p-8 md:p-12 text-white flex flex-col justify-between relative overflow-hidden bg-dynamic">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    <h3 class="text-xl md:text-2xl font-bold mb-4 md:mb-6">Kontak Langsung</h3>
                    <p class="mb-8 md:mb-10 text-white/90 leading-relaxed text-sm">Jangan ragu untuk menghubungi. Saya biasanya membalas dalam waktu 24 jam.</p>
                    
                    <div class="space-y-6">
                        @if(isset($home->contact_email) && $home->contact_email)
                        <div class="flex items-start space-x-4">
                            <div class="p-2 bg-white/20 rounded-lg flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-[10px] md:text-xs text-white/70 uppercase font-bold tracking-wider">Email</p>
                                <p class="font-medium text-sm truncate">{{ $home->contact_email }}</p>
                            </div>
                        </div>
                        @endif

                        @if(isset($home->contact_whatsapp) && $home->contact_whatsapp)
                        <a href="https://wa.me/{{ $home->contact_whatsapp }}" target="_blank" class="flex items-start space-x-4 group cursor-pointer">
                            <div class="p-2 bg-white/20 rounded-lg group-hover:bg-green-500 transition flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] md:text-xs text-white/70 uppercase font-bold tracking-wider">WhatsApp</p>
                                <p class="font-medium text-sm">Chat Sekarang &rarr;</p>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>

                <div class="relative z-10 mt-10 md:mt-12">
                    <p class="text-[10px] md:text-xs text-white/70 uppercase font-bold tracking-wider mb-3 md:mb-4">Social Media</p>
                    <div class="flex space-x-3 md:space-x-4">
                        @if(isset($home->contact_instagram) && $home->contact_instagram)
                        <a href="https://instagram.com/{{ $home->contact_instagram }}" target="_blank" class="p-2.5 md:p-3 bg-white/10 rounded-full hover:bg-white/30 transition shadow-inner">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        @endif

                        @if(isset($home->contact_github) && $home->contact_github)
                        <a href="{{ $home->contact_github }}" target="_blank" class="p-2.5 md:p-3 bg-white/10 rounded-full hover:bg-white/30 transition shadow-inner">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="w-full md:w-3/5 p-6 sm:p-8 md:p-12 bg-white">
                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-5 md:mb-8">
                        <label class="block text-gray-500 text-[10px] md:text-xs font-bold uppercase tracking-wider mb-2">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:bg-white transition duration-200 focus-ring-dynamic text-base sm:text-sm" placeholder="Masukkan nama Anda" required>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 md:gap-6 mb-5 md:mb-8">
                        <div>
                            <label class="block text-gray-500 text-[10px] md:text-xs font-bold uppercase tracking-wider mb-2">Email Address</label>
                            <input type="email" name="email" class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:bg-white transition duration-200 focus-ring-dynamic text-base sm:text-sm" placeholder="email@contoh.com" required>
                        </div>
                        <div>
                            <label class="block text-gray-500 text-[10px] md:text-xs font-bold uppercase tracking-wider mb-2">No. WhatsApp</label>
                            <input type="number" name="phone" class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:bg-white transition duration-200 focus-ring-dynamic text-base sm:text-sm" placeholder="0812xxxx" required>
                        </div>
                    </div>
                    
                    <div class="mb-6 md:mb-8">
                        <label class="block text-gray-500 text-[10px] md:text-xs font-bold uppercase tracking-wider mb-2">Isi Pesan</label>
                        <textarea name="message" rows="4" class="w-full px-4 py-3 md:py-3.5 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:bg-white transition duration-200 focus-ring-dynamic text-base sm:text-sm" placeholder="Ceritakan detail project atau pertanyaan Anda..." required></textarea>
                    </div>
                    
                    <button type="submit" class="w-full py-3.5 md:py-4 px-6 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/20 hover:shadow-xl hover:opacity-90 transition duration-300 transform hover:-translate-y-1 bg-dynamic text-base md:text-lg">
                        Kirim Pesan Sekarang 🚀
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<footer class="bg-white border-t border-gray-100 py-10 md:py-12 mt-auto">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6 md:gap-0">
        <div class="text-center md:text-left">
            <span class="font-bold text-lg md:text-xl tracking-tight text-gray-900 block">{{ $home->site_name ?? 'Portfolio' }}</span>
            <p class="text-gray-400 text-xs md:text-sm mt-1.5 md:mt-2">{{ $home->footer_text ?? '© ' . date('Y') . '. All rights reserved.' }}</p>
        </div>
        <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-6">
            <a href="#about" class="text-xs md:text-sm font-medium text-gray-500 hover-text-dynamic transition">Home</a>
            <a href="#services" class="text-xs md:text-sm font-medium text-gray-500 hover-text-dynamic transition">Services</a>
            <a href="#projects" class="text-xs md:text-sm font-medium text-gray-500 hover-text-dynamic transition">Works</a>
            <a href="#contact" class="text-xs md:text-sm font-medium text-gray-500 hover-text-dynamic transition">Contact</a>
        </div>
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

        // 2. Progress Bar Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const progressBar = entry.target;
                    const width = progressBar.getAttribute('data-width');
                    progressBar.style.width = width;
                    observer.unobserve(progressBar);
                }
            });
        }, { threshold: 0.5 });
        document.querySelectorAll('.progress-bar').forEach(bar => { observer.observe(bar); });

        // 3. Project Filter Logic
        const filterBtns = document.querySelectorAll('.filter-btn');
        const projectCards = document.querySelectorAll('.project-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('bg-dynamic', 'text-white', 'shadow-lg', 'shadow-indigo-500/30');
                    b.classList.add('bg-gray-50', 'text-gray-600', 'border-gray-200');
                });
                btn.classList.remove('bg-gray-50', 'text-gray-600', 'border-gray-200');
                btn.classList.add('bg-dynamic', 'text-white', 'shadow-lg', 'shadow-indigo-500/30');

                const filterValue = btn.getAttribute('data-filter');

                projectCards.forEach(card => {
                    const categories = card.getAttribute('data-category');
                    if (filterValue === 'all' || (categories && categories.includes(filterValue))) {
                        card.classList.remove('project-hidden');
                        card.style.display = 'flex';
                    } else {
                        card.classList.add('project-hidden');
                        setTimeout(() => { 
                            if(card.classList.contains('project-hidden')) {
                                card.style.display = 'none'; 
                            }
                        }, 400);
                    }
                });
            });
        });
    });
</script>


</body>
</html>
