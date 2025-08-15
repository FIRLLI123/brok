<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">Admin Dashboard</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Total Mitra Card -->
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-blue-800">Total Mitra</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ \App\Models\User::where('role', 'mitra')->count() }}</p>
                        </div>

                        <!-- Pending Mitra Card -->
                        <div class="bg-yellow-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-yellow-800">Pending Mitra</h3>
                            <p class="text-3xl font-bold text-yellow-600">
                                {{ \App\Models\User::where('role', 'mitra')->where('is_active', false)->count() }}
                            </p>
                        </div>

                        <!-- Total Kost Card -->
                        <div class="bg-green-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-green-800">Total Kost</h3>
                            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Kost::count() }}</p>
                        </div>
                    </div>

                    <!-- Recent Mitra Registrations -->
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">Recent Mitra Registrations</h3>
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach(\App\Models\User::where('role', 'mitra')->latest()->take(5)->get() as $mitra)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $mitra->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $mitra->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($mitra->is_active)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.mitra.index') }}" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 