<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Daftar Kamar</h2>
                        <a href="{{ route('mitra.rooms.create') }}"
                           class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Tambah Kamar
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($rooms->isNotEmpty())
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border p-3 text-left">No</th>
                                        <th class="border p-3 text-left">Nama Kost</th>
                                        <th class="border p-3 text-left">Nomor Kamar</th>
                                        <th class="border p-3 text-left">Harga/Bulan</th>
                                        <th class="border p-3 text-left">Status</th>
                                        <th class="border p-3 text-left">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rooms as $index => $room)
                                        <tr class="hover:bg-gray-50">
                                            <td class="border p-3">{{ $rooms->firstItem() + $index }}</td>
                                            <td class="border p-3">{{ $room->kost->name }}</td>
                                            <td class="border p-3">{{ $room->room_number }}</td>
                                            <td class="border p-3">Rp {{ number_format($room->price, 0, ',', '.') }}</td>
                                            <td class="border p-3">
                                                @if($room->is_available)
                                                    <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs rounded">
                                                        Tersedia
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-800 text-xs rounded">
                                                        Tidak Tersedia
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="border p-3">
                                                <div class="flex gap-2 items-center">
                                                    <a href="{{ route('mitra.rooms.edit', $room) }}"
                                                       class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-800 text-xs font-medium rounded-full hover:bg-blue-200 cursor-pointer">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('mitra.rooms.destroy', $room) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Yakin ingin menghapus kamar ini?');"
                                                          class="inline-flex items-center m-0 p-0 leading-none">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-800 text-xs font-medium rounded-full hover:bg-red-200 cursor-pointer border-0 m-0 leading-none">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $rooms->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">Belum ada data kamar.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
