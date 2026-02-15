<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Layanan (Services)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md shadow-sm">
                <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl sticky top-24">
                        <div class="p-6 bg-indigo-600">
                            <h3 class="text-lg font-bold text-white">Tambah Layanan</h3>
                            <p class="text-indigo-200 text-xs mt-1">Lengkapi info layanan & tools.</p>
                        </div>
                        <div class="p-6 bg-white">
                            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Judul Layanan</label>
                                    <input type="text" name="title" placeholder="Contoh: Web Development" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Tech Stack (Pisahkan koma)</label>
                                    <input type="text" name="tech_stack" placeholder="Laravel, React, MySQL" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Gambar / Ikon</label>
                                    <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Estimasi Harga</label>
                                    <input type="text" name="price" placeholder="Mulai Rp 1.500.000" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>

                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                                    <textarea name="description" rows="3" placeholder="Deskripsi singkat..." class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                                </div>

                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition">Simpan Layanan</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($services as $service)
                        <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 relative group flex flex-col h-full">
                            
                            <div class="h-40 bg-gray-100 overflow-hidden relative">
                                @if($service->image)
                                    {{-- PERBAIKAN DI SINI: Support ImgBB (http) dan Local Storage --}}
                                    <img src="{{ \Illuminate\Support\Str::startsWith($service->image, 'http') ? $service->image : asset('storage/' . $service->image) }}" 
                                         alt="{{ $service->title }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full bg-indigo-50 text-indigo-300">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                                
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')" class="absolute top-2 right-2">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-white/80 p-1.5 rounded-full text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm backdrop-blur-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>

                            <div class="p-5 flex flex-col flex-1">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $service->title }}</h3>
                                
                                @if($service->tech_stack)
                                <div class="flex flex-wrap gap-1 mb-3">
                                    @foreach(explode(',', $service->tech_stack) as $tech)
                                        <span class="px-2 py-0.5 text-[10px] font-bold bg-gray-100 text-gray-600 rounded uppercase tracking-wide border border-gray-200">{{ trim($tech) }}</span>
                                    @endforeach
                                </div>
                                @endif

                                <p class="text-gray-500 text-sm mb-4 flex-1">{{ $service->description }}</p>
                                
                                @if($service->price)
                                    <div class="mt-auto pt-3 border-t border-gray-100">
                                        <span class="text-xs text-gray-400">Harga:</span>
                                        <span class="block text-indigo-600 font-bold">{{ $service->price }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="col-span-2 text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                            <p class="text-gray-500">Belum ada layanan.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>