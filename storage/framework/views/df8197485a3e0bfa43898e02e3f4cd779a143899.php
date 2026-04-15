<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">Mitra Dashboard</h2>
                    
                    <?php if(!auth()->user()->is_active): ?>
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                            <p>Akun Anda sedang menunggu persetujuan dari admin. Anda akan dapat mengelola kost setelah akun disetujui.</p>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Total Kost Card -->
                        <div class="bg-blue-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-blue-800">Total Kost</h3>
                            <p class="text-3xl font-bold text-blue-600"><?php echo e(auth()->user()->kost()->count()); ?></p>
                        </div>

                        <!-- Total Rooms Card -->
                        <div class="bg-green-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-green-800">Total Kamar</h3>
                            <p class="text-3xl font-bold text-green-600">
                                <?php echo e(\App\Models\Room::whereIn('kost_id', auth()->user()->kost()->pluck('id'))->count()); ?>

                            </p>
                        </div>

                        <!-- Active Bookings Card -->
                        <div class="bg-purple-100 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-purple-800">Active Bookings</h3>
                            <p class="text-3xl font-bold text-purple-600">
                                <?php echo e(\App\Models\Booking::whereIn('room_id', 
                                    \App\Models\Room::whereIn('kost_id', auth()->user()->kost()->pluck('id'))->pluck('id')
                                )->where('status', 'approved')->count()); ?>

                            </p>
                        </div>
                    </div>

                    <!-- Recent Bookings -->
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">Recent Bookings</h3>
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kost</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__currentLoopData = \App\Models\Booking::whereIn('room_id', 
                                        \App\Models\Room::whereIn('kost_id', auth()->user()->kost()->pluck('id'))->pluck('id')
                                    )->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($booking->room->kost->name); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($booking->room->room_number); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($booking->user->name); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if($booking->status === 'approved'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                                            <?php elseif($booking->status === 'pending'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                            <?php else: ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="<?php echo e(route('mitra.bookings.index')); ?>" class="text-indigo-600 hover:text-indigo-900">View Details</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?> <?php /**PATH C:\laragon\www\Brock\resources\views/mitra/dashboard.blade.php ENDPATH**/ ?>