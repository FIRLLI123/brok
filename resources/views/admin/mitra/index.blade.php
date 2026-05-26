<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Mitra') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Daftar Mitra</h3>

                    <div class="mt-4">
                        <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Akun</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Verifikasi Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Kost</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($mitras as $mitra)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $mitra->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $mitra->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $mitra->phone ?: '-' }}</td>
                                        <td class="px-6 py-4 min-w-[220px] text-sm text-gray-700">{{ $mitra->address ?: '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-700">
                                                {{ ucfirst($mitra->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $mitra->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $mitra->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $mitra->email_verified_at ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-700' }}">
                                                {{ $mitra->email_verified_at ? 'Terverifikasi' : 'Belum' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $mitra->kost_count }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ optional($mitra->created_at)->format('d M Y H:i') ?: '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if(!$mitra->is_active)
                                                <form action="{{ route('admin.mitra.approve', ['user' => $mitra]) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="text-indigo-600 hover:text-indigo-900">Aktifkan</button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.mitra.reject', ['user' => $mitra]) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Nonaktifkan</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Belum ada data mitra.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 
