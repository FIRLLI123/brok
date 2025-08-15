<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Tambah Ulasan')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <a href="<?php echo e(route('user.bookings.index')); ?>" class="text-indigo-600 hover:text-indigo-900">
                            &larr; Kembali ke Daftar Booking
                        </a>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Detail Booking</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p><strong>Kost:</strong> <?php echo e($booking->room->kost->name); ?></p>
                            <p><strong>Kamar:</strong> <?php echo e($booking->room->room_number); ?></p>
                            <p><strong>Tanggal:</strong> <?php echo e(\Carbon\Carbon::parse($booking->start_date)->format('d M Y')); ?> - <?php echo e(\Carbon\Carbon::parse($booking->end_date)->format('d M Y')); ?></p>
                            <p><strong>Total Harga:</strong> Rp <?php echo e(number_format($booking->total_price, 0, ',', '.')); ?></p>
                        </div>
                    </div>

                    <form action="<?php echo e(route('user.reviews.store', $booking)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-4">
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <div class="flex items-center space-x-4">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <label class="flex items-center">
                                        <input type="radio" name="rating" value="<?php echo e($i); ?>" 
                                               class="mr-2" <?php echo e(old('rating') == $i ? 'checked' : ''); ?> required>
                                        <span class="text-yellow-400">
                                            <?php for($j = 1; $j <= $i; $j++): ?>
                                                ★
                                            <?php endfor; ?>
                                        </span>
                                    </label>
                                <?php endfor; ?>
                            </div>
                            <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Ulasan</label>
                            <textarea name="comment" id="comment" rows="4" 
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                      placeholder="Bagikan pengalaman Anda selama menginap di kost ini..." required><?php echo e(old('comment')); ?></textarea>
                            <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Kirim Ulasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?> <?php /**PATH C:\laragon\www\Brock\resources\views/user/reviews/create.blade.php ENDPATH**/ ?>