<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Semua Layanan - {{ $home->site_name }}</title>
    
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
        .hover-text-dynamic:hover { color: var(--primary-color); }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <nav class="fixed w-full top-0 z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl md:text-2xl font-bold text-dynamic tracking-tight hover:opacity-80 transition">
                    {{ $home->site_name }}
                </a>
                
                <div class="hidden md:flex space-x-8 text-sm font-semibold text-gray-600">
                    <a href="{{ route('home') }}" class="hover-text-dynamic transition duration-200">Home</a>
                    <a href="{{ route('public.projects') }}" class="hover-text-dynamic transition duration-200">Projects</a>
                    <a href="{{ route('home') }}#contact" class="px-5 py-2 rounded-full bg-gray-900 text-white hover-bg-dynamic transition duration-200">Hubungi Saya</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="pt-32 pb-10 px-6 text-center bg-white border-b border-gray-100">
        <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Layanan Lengkap</h1>
        <p class="text-gray-500 max-w-2xl mx-auto">Solusi digital yang saya tawarkan untuk kebutuhan bisnis Anda.</p>
    </div>

    <section class="py-20 bg-gray-50 flex-grow">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($services as $service)
                <div class="bg-white rounded-3xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 hover:-translate-y-2 group overflow-hidden flex flex-col h-full">
                    
                    <div class="h-48 overflow-hidden relative bg-gray-100">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="flex items-center justify-center h-full bg-dynamic-light text-dynamic">
                                <svg class="w-16 h-16 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>
                        
                        @if($service->price)
                        <div class="absolute bottom-4 left-4">
                            <span class="bg-white/90 backdrop-blur-sm text-gray-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                {{ $service->price }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <div class="p-8 flex flex-col flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover-text-dynamic transition">{{ $service->title }}</h3>
                        
                        @if($service->tech_stack)
                        <div class="flex flex-wrap gap-1.5 mb-4">
                            @foreach(explode(',', $service->tech_stack) as $tech)
                                <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-md bg-gray-100 text-gray-500 border border-gray-200">
                                    {{ trim($tech) }}
                                </span>
                            @endforeach
                        </div>
                        @endif

                        <p class="text-gray-500 text-sm leading-relaxed flex-1">
                            {{ $service->description }}
                        </p>
                        
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <a href="{{ route('home') }}#contact" class="text-sm font-bold text-dynamic flex items-center gap-2 hover:gap-3 transition-all">
                                Pesan Layanan Ini <span class="text-lg leading-none">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12 text-gray-400">
                    Belum ada layanan yang ditambahkan.
                </div>
                @endforelse
            </div>

        </div>
    </section>

    <footer class="bg-white border-t border-gray-100 py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <span class="font-bold text-xl tracking-tight text-gray-900 block">{{ $home->site_name }}</span>
            <p class="text-gray-400 text-sm mt-2">{{ $home->footer_text }}</p>
        </div>
    </footer>

</body>
</html>