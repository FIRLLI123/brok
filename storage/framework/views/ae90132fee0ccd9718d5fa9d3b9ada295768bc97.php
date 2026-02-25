<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Daftar Kamar</h2>
                        <a href="<?php echo e(route('mitra.rooms.create')); ?>"
                           class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Tambah Kamar
                        </a>
                    </div>

                    <?php if(session('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($rooms->isNotEmpty()): ?>
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
                                    <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="border p-3"><?php echo e($rooms->firstItem() + $index); ?></td>
                                            <td class="border p-3"><?php echo e($room->kost->name); ?></td>
                                            <td class="border p-3"><?php echo e($room->room_number); ?></td>
                                            <td class="border p-3">Rp <?php echo e(number_format($room->price, 0, ',', '.')); ?></td>
                                            <td class="border p-3">
                                                <?php if($room->is_available): ?>
                                                    <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs rounded">
                                                        Tersedia
                                                    </span>
                                                <?php else: ?>
                                                    <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-800 text-xs rounded">
                                                        Tidak Tersedia
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="border p-3">
                                                <div class="flex gap-2 items-center">
                                                    <a href="<?php echo e(route('mitra.rooms.edit', $room)); ?>"
                                                       class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-800 text-xs font-medium rounded-full hover:bg-blue-200 cursor-pointer">
                                                        Edit
                                                    </a>
                                                    <form action="<?php echo e(route('mitra.rooms.destroy', $room)); ?>"
                                                          method="POST"
                                                          onsubmit="return confirm('Yakin ingin menghapus kamar ini?');"
                                                          class="inline-flex items-center m-0 p-0 leading-none">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-800 text-xs font-medium rounded-full hover:bg-red-200 cursor-pointer border-0 m-0 leading-none">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <?php echo e($rooms->links()); ?>

                        </div>
                    <?php else: ?>
                        <p class="text-gray-500 text-center py-8">Belum ada data kamar.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\Brock\resources\views/mitra/rooms/index.blade.php ENDPATH**/ ?>