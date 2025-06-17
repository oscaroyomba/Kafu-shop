

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6">Your Shopping Cart</h2>

    <?php if(session('success')): ?>
        <div class="mb-4 text-green-600 font-semibold"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(count($cart) > 0): ?>
        <div class="space-y-4">
            <?php $total = 0; ?>
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; ?>
                <div class="flex items-center justify-between border-b pb-4">
                    <div class="flex items-center space-x-4">
                        <img src="<?php echo e(asset('storage/' . $item['image'])); ?>" alt="<?php echo e($item['name']); ?>" class="w-16 h-16 object-cover rounded">
                        <div>
                            <div class="font-semibold"><?php echo e($item['name']); ?></div>
                            <div class="text-sm text-gray-600">ETB <?php echo e(number_format($item['price'], 2)); ?></div>
                            <div class="text-xs text-gray-400">Subtotal: ETB <?php echo e(number_format($subtotal, 2)); ?></div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        
                        <form action="<?php echo e(route('cart.update', $id)); ?>" method="POST" class="flex items-center space-x-2">
                            <?php echo csrf_field(); ?>
                            <input type="number" name="quantity" value="<?php echo e($item['quantity']); ?>" min="1"
                                   class="w-16 text-center border rounded px-2 py-1">
                            <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 text-sm">
                                Update
                            </button>
                        </form>

                        
                        <form action="<?php echo e(route('cart.remove', $id)); ?>" method="POST" onsubmit="return confirm('Remove this item?')">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-red-600 text-sm hover:underline">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-6 text-right">
            <div class="text-xl font-bold">Total: ETB <?php echo e(number_format($total, 2)); ?></div>
        </div>

        
        <div class="mt-4 text-right">
            <a href="<?php echo e(route('cart.checkout')); ?>"
               class="bg-green-600 text-black px-6 py-2 rounded hover:bg-green-700 transition text-sm shadow">
                Proceed to Checkout
            </a>
        </div>
    <?php else: ?>
        <p class="text-gray-600">Your cart is empty.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\kafu\resources\views/cart/index.blade.php ENDPATH**/ ?>