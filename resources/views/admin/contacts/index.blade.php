<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inbox / Pesan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <form action="{{ route('inbox.index') }}" method="GET" class="w-full md:w-1/2 flex gap-2">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari nama, email, atau isi pesan..." 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            
                            @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                            @endif

                            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                                Cari
                            </button>
                        </form>

                        <div class="w-full md:w-auto flex items-center gap-2">
                            <span class="text-sm text-gray-500">Urutkan:</span>
                            <form action="{{ route('inbox.index') }}" method="GET">
                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                
                                <select name="sort" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="overflow-x-auto border rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengirim</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preview Pesan</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($contacts as $contact)
                                <tr id="row-{{ $contact->id }}" class="hover:bg-gray-50 transition {{ $contact->is_read ? '' : 'bg-yellow-50 font-semibold' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $contact->name }}</div>
                                        <div class="text-xs text-gray-400 font-normal">{{ $contact->created_at->format('d M Y, H:i') }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600 mb-1 font-normal">{{ $contact->email }}</div>
                                        
                                        @php
                                            $nohp = $contact->phone;
                                            if(substr(trim($nohp), 0, 1) == '0'){
                                                $nohp = '62'.substr(trim($nohp), 1);
                                            }
                                        @endphp
                                        
                                        <a href="https://wa.me/{{ $nohp }}?text=Halo%20{{ $contact->name }},%20saya%20sudah%20membaca%20pesan%20Anda." target="_blank" class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded hover:bg-green-200 transition">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                            Chat WA
                                        </a>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 break-words font-normal">{{ Str::limit($contact->message, 50) }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex justify-center items-center space-x-3">
                                            <button onclick="openModal({{ $contact->id }}, '{{ $contact->name }}', '{{ $contact->email }}', '{{ $contact->phone }}', '{{ $contact->created_at->format('d M Y H:i') }}', `{{ $contact->message }}`)" 
                                                    class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">
                                                Lihat Detail
                                            </button>

                                            <form action="{{ route('inbox.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini permanen?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-600 transition" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500 bg-gray-50">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                            <span class="text-lg">Tidak ada pesan ditemukan.</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $contacts->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal()"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 border-b pb-2 mb-4" id="modal-title">
                                Detail Pesan
                            </h3>
                            <div class="mt-2 space-y-3">
                                <div>
                                    <label class="text-xs text-gray-500 uppercase font-bold">Pengirim</label>
                                    <p id="modalName" class="text-sm font-medium text-gray-900"></p>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-xs text-gray-500 uppercase font-bold">Email</label>
                                        <p id="modalEmail" class="text-sm text-gray-600"></p>
                                    </div>
                                    <div>
                                        <label class="text-xs text-gray-500 uppercase font-bold">WhatsApp</label>
                                        <p id="modalPhone" class="text-sm text-gray-600"></p>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 uppercase font-bold">Waktu Masuk</label>
                                    <p id="modalDate" class="text-sm text-gray-600"></p>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-md border">
                                    <label class="text-xs text-gray-500 uppercase font-bold mb-1 block">Isi Pesan</label>
                                    <p id="modalMessage" class="text-sm text-gray-800 whitespace-pre-wrap"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal()">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(id, name, email, phone, date, message) {
            // 1. Isi data ke modal
            document.getElementById('modalName').textContent = name;
            document.getElementById('modalEmail').textContent = email;
            document.getElementById('modalPhone').textContent = phone;
            document.getElementById('modalDate').textContent = date;
            document.getElementById('modalMessage').textContent = message;

            // 2. Tampilkan modal
            document.getElementById('detailModal').classList.remove('hidden');

            // 3. AJAX: Tandai pesan sudah dibaca
            fetch(`/inbox/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if(response.ok) {
                    // Update tampilan baris tabel secara real-time (Hilangkan highlight)
                    const row = document.getElementById(`row-${id}`);
                    if (row) {
                        row.classList.remove('bg-yellow-50', 'font-semibold');
                    }
                }
            });
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        // Tutup modal dengan tombol ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeModal();
            }
        });
    </script>
</x-app-layout>