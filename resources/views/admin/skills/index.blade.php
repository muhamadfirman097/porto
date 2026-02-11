<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Skill & Tools') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md shadow-sm flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl sticky top-24">
                        <div class="p-6 bg-indigo-600">
                            <h3 class="text-lg font-bold text-white flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Tambah Skill Baru
                            </h3>
                            <p class="text-indigo-200 text-xs mt-1">Upload logo & atur persentase.</p>
                        </div>
                        
                        <div class="p-6 bg-white">
                            <form action="{{ route('skills.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Skill</label>
                                    <input type="text" name="name" placeholder="Misal: Laravel" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Logo / Icon</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label class="flex flex-col w-full h-32 border-2 border-dashed border-gray-300 hover:bg-gray-50 hover:border-indigo-300 rounded-xl cursor-pointer transition">
                                            <div class="flex flex-col items-center justify-center pt-7">
                                                <svg class="w-8 h-8 text-gray-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                <p class="pt-1 text-xs tracking-wider text-gray-400 group-hover:text-indigo-500">Pilih Foto</p>
                                            </div>
                                            <input type="file" name="image" class="opacity-0" />
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1 text-center">Format: PNG/JPG (Max 1MB)</p>
                                </div>

                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Persentase Penguasaan</label>
                                    <div class="relative">
                                        <input type="number" name="percentage" placeholder="1-100" min="1" max="100" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 pr-8" required>
                                        <span class="absolute right-3 top-2 text-gray-500 font-bold">%</span>
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 flex justify-center items-center">
                                    Simpan Data
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-gray-100">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-800">Daftar Keahlian</h3>
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $skills->count() }} Item</span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse($skills as $skill)
                            <div class="flex items-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition hover:border-indigo-200 group">
                                
                                <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-gray-50 flex items-center justify-center mr-4 overflow-hidden border border-gray-100 group-hover:bg-indigo-50 transition">
                                    @if($skill->image)
                                        <img src="{{ asset('storage/' . $skill->image) }}" class="h-8 w-8 object-contain" alt="{{ $skill->name }}">
                                    @else
                                        <span class="text-lg font-bold text-indigo-500">{{ substr($skill->name, 0, 1) }}</span>
                                    @endif
                                </div>

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $skill->name }}</p>
                                    <div class="flex items-center mt-1">
                                        <div class="w-full bg-gray-200 rounded-full h-1.5 mr-2">
                                            <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ $skill->percentage }}%"></div>
                                        </div>
                                        <span class="text-xs text-gray-500 font-medium">{{ $skill->percentage }}%</span>
                                    </div>
                                </div>

                                <div class="ml-4 flex items-center space-x-1">
                                    
                                    <a href="{{ route('skills.edit', $skill->id) }}" class="p-2 text-yellow-500 hover:bg-yellow-50 rounded-lg transition" title="Edit Skill">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>

                                    <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $skill->name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus Skill">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>

                            </div>
                            @empty
                            <div class="col-span-1 md:col-span-2 text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                                <div class="mx-auto h-12 w-12 text-gray-300 mb-3">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                </div>
                                <h3 class="text-sm font-medium text-gray-900">Belum ada skill</h3>
                                <p class="mt-1 text-sm text-gray-500">Mulai dengan mengisi formulir di sebelah kiri.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>