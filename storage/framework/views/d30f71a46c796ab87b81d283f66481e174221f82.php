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
                    <?php if(session('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">Daftar Booking</h2>
                        
                        <!-- Filter Status -->
                        <div class="flex space-x-2">
                            <a href="<?php echo e(route('mitra.bookings.index')); ?>" 
                               class="px-4 py-2 rounded-md <?php echo e(!request('status') ? 'bg-blue-500 text-white' : 'bg-gray-200'); ?>">
                                Semua
                            </a>
                            <a href="<?php echo e(route('mitra.bookings.index', ['status' => 'pending'])); ?>" 
                               class="px-4 py-2 rounded-md <?php echo e(request('status') === 'pending' ? 'bg-blue-500 text-white' : 'bg-gray-200'); ?>">
                                Pending
                            </a>
                            <a href="<?php echo e(route('mitra.bookings.index', ['status' => 'approved'])); ?>" 
                               class="px-4 py-2 rounded-md <?php echo e(request('status') === 'approved' ? 'bg-blue-500 text-white' : 'bg-gray-200'); ?>">
                                Done
                            </a>
                            <a href="<?php echo e(route('mitra.bookings.index', ['status' => 'rejected'])); ?>" 
                               class="px-4 py-2 rounded-md <?php echo e(request('status') === 'rejected' ? 'bg-blue-500 text-white' : 'bg-gray-200'); ?>">
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($booking->room->kost->name); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">Kamar <?php echo e($booking->room->room_number); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($booking->user->name); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e(\Carbon\Carbon::parse($booking->start_date)->format('d/m/Y')); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e(\Carbon\Carbon::parse($booking->end_date)->format('d/m/Y')); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if($booking->status === 'approved'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Done
                                                </span>
                                            <?php elseif($booking->status === 'pending'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            <?php else: ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Ditolak
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <?php if($booking->status === 'pending'): ?>
                                                <form action="<?php echo e(route('mitra.bookings.approve', $booking)); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-2">
                                                        Setujui
                                                    </button>
                                                </form>
                                                <form action="<?php echo e(route('mitra.bookings.reject', $booking)); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        Tolak
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                            Tidak ada data booking
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <?php echo e($bookings->links()); ?>

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
<?php endif; ?> <?php /**PATH C:\laragon\www\Brock\resources\views/mitra/bookings/index.blade.php ENDPATH**/ ?>