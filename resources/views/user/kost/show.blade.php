<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="{{ route('user.kost.index') }}" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Kembali ke Daftar Kost
                        </a>
                    </div>

                    <!-- Kost Images -->
                    <div class="mb-8">
                        @if($kost->images->isNotEmpty())
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($kost->images as $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                         alt="{{ $kost->name }}" 
                                         class="w-full h-64 object-cover rounded-lg">
                                @endforeach
                            </div>
                        @else
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-gray-400">No Images Available</span>
                            </div>
                        @endif
                    </div>

                    <!-- Kost Details -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-2">
                            <h1 class="text-3xl font-bold mb-4">{{ $kost->name }}</h1>
                            
                            <div class="mb-6">
                                <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
                                <p class="text-gray-600">{{ $kost->description }}</p>
                            </div>

                            <div class="mb-6">
                                <h2 class="text-xl font-semibold mb-2">Lokasi</h2>
                                <p class="text-gray-600">{{ $kost->address }}</p>
                                <p class="text-gray-600">{{ $kost->city }}</p>
                            </div>

                            <div class="mb-6">
                                <h2 class="text-xl font-semibold mb-2">Fasilitas</h2>
                                <ul class="list-disc list-inside text-gray-600">
                                    <li>Kamar Mandi Dalam</li>
                                    <li>Wifi</li>
                                    <li>Listrik</li>
                                    <li>Air</li>
                                    <li>Parkir</li>
                                </ul>
                            </div>

                            <!-- Reviews Section -->
                            <div class="mb-6">
                                <h2 class="text-xl font-semibold mb-4">Ulasan Pengguna</h2>
                                @if($kost->reviews->isNotEmpty())
                                    <div class="space-y-4">
                                        @foreach($kost->reviews as $review)
                                            <div class="border rounded-lg p-4">
                                                <div class="flex items-center justify-between mb-2">
                                                    <div class="flex items-center">
                                                        <span class="font-semibold">{{ $review->user->name }}</span>
                                                        <div class="flex items-center ml-2">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <span class="text-yellow-400 {{ $i <= $review->rating ? '' : 'text-gray-300' }}">
                                                                    ★
                                                                </span>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <span class="text-sm text-gray-500">
                                                        {{ $review->created_at->format('d M Y') }}
                                                    </span>
                                                </div>
                                                <p class="text-gray-700 mb-3">{{ $review->comment }}</p>
                                                
                                                <!-- Review Replies -->
                                                @if($review->replies->isNotEmpty())
                                                    <div class="ml-6 border-l-2 border-gray-200 pl-4">
                                                        @foreach($review->replies as $reply)
                                                            <div class="mb-2">
                                                                <div class="flex items-center justify-between">
                                                                    <span class="font-semibold text-sm">{{ $reply->user->name }} (Pemilik)</span>
                                                                    <span class="text-xs text-gray-500">
                                                                        {{ $reply->created_at->format('d M Y') }}
                                                                    </span>
                                                                </div>
                                                                <p class="text-sm text-gray-600">{{ $reply->reply }}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500">Belum ada ulasan untuk kost ini.</p>
                                @endif
                            </div>
                        </div>

                        <div class="md:col-span-1">
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h2 class="text-2xl font-bold text-indigo-600 mb-4">
                                    Mulai Rp {{ number_format($kost->price, 0, ',', '.') }}/bulan
                                </h2>

                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold mb-2">Kamar Tersedia</h3>
                                    @if($kost->rooms->isNotEmpty())
                                        <div class="space-y-4">
                                            @foreach($kost->rooms as $room)
                                                <div class="border rounded-lg p-4 bg-white">
                                                    <div class="flex justify-between items-center mb-2">
                                                        <div class="flex items-center gap-2">
                                                            <span class="font-semibold">Kamar {{ $room->room_number }}</span>
                                                            @if($room->is_available == 1)
                                                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                                                    Tersedia
                                                                </span>
                                                            @elseif($room->is_available == 2)
                                                                <span class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                                                    Dipesan
                                                                </span>
                                                            @elseif($room->is_available == 3)
                                                                <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                                                    Terisi
                                                                </span>
                                                            @else
                                                                <span class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                                                                    Tidak Tersedia
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <span class="text-indigo-600 font-bold">
                                                            Rp {{ number_format($room->price, 0, ',', '.') }}/bulan
                                                        </span>
                                                    </div>
                                                    <p class="text-sm text-gray-600 mb-4">{{ $room->description }}</p>
                                                    
                                                    <!-- Booking Form -->
                                                    <form action="{{ route('user.bookings.store') }}" method="POST" class="space-y-3">
                                                        @csrf
                                                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                                                        <input type="hidden" name="room_price" value="{{ $room->price }}">
                                                        
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                                                            <input type="date" name="start_date" required
                                                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                        </div>
                                                        
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                                                            <input type="date" name="end_date" required
                                                                   min="{{ date('Y-m-d', strtotime('+2 days')) }}"
                                                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                        </div>
                                                        
                                                        <div class="bg-blue-50 p-3 rounded">
                                                            <p class="text-sm text-blue-800">
                                                                <strong>Total Harga:</strong> 
                                                                <span id="total-price-{{ $room->id }}" class="font-bold">
                                                                    Rp {{ number_format($room->price, 0, ',', '.') }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                        
                                                        @if($kost->is_active == 1)
                                                            <button type="submit" 
                                                                    class="w-full mt-4 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 font-semibold text-sm">
                                                                Booking Sekarang
                                                            </button>
                                                        @else
                                                            <div class="w-full mt-4 text-center">
                                                                @if($kost->is_active == 2)
                                                                    <span class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                                                        Sedang Dipesan
                                                                    </span>
                                                                @elseif($kost->is_active == 3)
                                                                    <span class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                                                        Sudah Terisi
                                                                    </span>
                                                                @else
                                                                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                                                                        Tidak Tersedia
                                                                    </span>
                                                                @endif
                                                                <p class="text-xs text-gray-500 mt-2">Booking tidak tersedia untuk kost ini</p>
                                                            </div>
                                                        @endif
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500">Tidak ada kamar yang tersedia</p>
                                    @endif
                                </div>

                                <div class="border-t pt-4">
                                    <h3 class="text-lg font-semibold mb-2">Kontak Pemilik</h3>
                                    <p class="text-gray-600">{{ $kost->user->name }}</p>
                                    @if($kost->user->phone)
                                        <p class="text-gray-600">{{ $kost->user->phone }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Calculate total price based on date range
        document.querySelectorAll('form').forEach(form => {
            const startDateInput = form.querySelector('input[name="start_date"]');
            const endDateInput = form.querySelector('input[name="end_date"]');
            const roomId = form.querySelector('input[name="room_id"]')?.value;
            const priceInput = form.querySelector('input[name="room_price"]');
            
            if (!startDateInput || !endDateInput || !roomId || !priceInput) return;
            
            const pricePerMonth = parseInt(priceInput.value);
            
            function calculateTotal() {
                if (startDateInput.value && endDateInput.value) {
                    const startDate = new Date(startDateInput.value);
                    const endDate = new Date(endDateInput.value);
                    const diffTime = Math.abs(endDate - startDate);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    const months = Math.ceil(diffDays / 30);
                    const totalPrice = pricePerMonth * months;
                    
                    const totalElement = document.getElementById(`total-price-${roomId}`);
                    if (totalElement) {
                        totalElement.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
                    }
                }
            }
            
            startDateInput.addEventListener('change', calculateTotal);
            endDateInput.addEventListener('change', calculateTotal);
        });
    </script>
</x-app-layout> 