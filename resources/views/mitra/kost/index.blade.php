<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Daftar Kost</h2>
                        <a href="{{ route('mitra.kost.create') }}"
                           style="display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: #2563eb; border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.08); transition: background 0.2s; margin-left: 8px;"
                           onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563eb'"
                           title="Tambah Kost Baru">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            <span style="display:none;">Tambah Kost Baru</span>
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($kosts as $kost)
                            <a href="{{ route('mitra.kost.show', $kost) }}" class="block">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 p-4">
                                    <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $kost->name }}</h3>
                                    <div class="space-y-2">
                                        <p class="text-gray-600 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $kost->address }}
                                        </p>
                                        <p class="text-gray-600 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                            {{ $kost->city }}
                                        </p>
                                        <p class="text-blue-600 font-semibold flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Rp {{ number_format($kost->price, 0, ',', '.') }}/bulan
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    @if($kosts->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500">Belum ada kost yang ditambahkan.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout> 