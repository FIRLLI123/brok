<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Daftar Booking</h2>
                        
                        <!-- Filter Status -->
                        <div class="flex space-x-2">
                            <a href="{{ route('mitra.bookings.index') }}" 
                               class="px-4 py-2 rounded-md {{ !request('status') ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                                Semua
                            </a>
                            <a href="{{ route('mitra.bookings.index', ['status' => 'pending']) }}" 
                               class="px-4 py-2 rounded-md {{ request('status') === 'pending' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                                Pending
                            </a>
                            <a href="{{ route('mitra.bookings.index', ['status' => 'approved']) }}" 
                               class="px-4 py-2 rounded-md {{ request('status') === 'approved' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                                Done
                            </a>
                            <a href="{{ route('mitra.bookings.index', ['status' => 'rejected']) }}" 
                               class="px-4 py-2 rounded-md {{ request('status') === 'rejected' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                                Ditolak
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kost</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kamar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penyewa</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Kamar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($bookings as $booking)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->room->kost->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Kamar {{ $booking->room->room_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($booking->start_date)->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($booking->end_date)->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($booking->status === 'approved')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Done
                                                </span>
                                            @elseif($booking->status === 'pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Ditolak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($booking->room->is_available == 1)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Tersedia 
                                                </span>
                                            @elseif($booking->room->is_available == 2)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Dipesan 
                                                </span>
                                            @elseif($booking->room->is_available == 3)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Terisi 
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Tidak Tersedia 
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($booking->status === 'pending')
                                                <form action="{{ route('mitra.bookings.approve', $booking) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-2">
                                                        Setujui
                                                    </button>
                                                </form>
                                                <form action="{{ route('mitra.bookings.reject', $booking) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        Tolak
                                                    </button>
                                                </form>
                                            @elseif($booking->status === 'approved')
                                                @if($booking->room->is_available == 2)
                                                    <form action="{{ route('mitra.bookings.setOccupied', $booking) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="text-blue-600 hover:text-blue-900 mr-2">
                                                            Terisi
                                                        </button>
                                                    </form>
                                                @elseif($booking->room->is_available == 3)
                                                    <form action="{{ route('mitra.bookings.setAvailable', $booking) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="text-green-600 hover:text-green-900">
                                                            Selesai
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                            Tidak ada data booking
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 