

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-6">

    
    <form method="GET" action="<?php echo e(route('products.index')); ?>" class="mb-6">
        <div class="flex gap-2 items-center">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                   placeholder="Search products..."
                   class="w-full px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Search
            </button>
        </div>
    </form>

    
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Filter by Tag</h2>
        <?php if($tags->count()): ?>
            <div class="flex flex-wrap gap-2">
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('products.index', ['tag' => $tag->name, 'search' => request('search')])); ?>"
                       class="px-3 py-1 border rounded-full text-sm 
                              <?php echo e(request('tag') == $tag->name ? 'bg-blue-600 text-white' : 'hover:bg-blue-100 text-gray-700'); ?>"
                       aria-label="Filter by tag <?php echo e($tag->name); ?>">
                        <?php echo e($tag->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(request('tag')): ?>
                    <a href="<?php echo e(route('products.index', ['search' => request('search')])); ?>"
                       class="ml-2 text-sm underline text-red-500">
                       Clear Filter
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <p class="text-sm text-gray-500 italic">No tags available.</p>
        <?php endif; ?>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 gap-y-8">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition bg-white">
                <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                     alt="<?php echo e($product->name ?? 'Product image'); ?>"
                     onerror="this.onerror=null;this.src='https://via.placeholder.com/300x150?text=No+Image';"
                     class="w-full h-40 object-cover rounded mb-3">

                <h3 class="text-lg font-semibold mb-1"><?php echo e($product->name); ?></h3>
                <p class="text-gray-600 text-sm mb-1">ETB <?php echo e(number_format($product->price, 2)); ?></p>

                
                <div class="flex flex-wrap gap-1 mb-3">
                    <?php $__currentLoopData = $product->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="text-xs bg-gray-100 px-2 py-1 rounded-full"><?php echo e($tag->name); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <form method="POST" action="<?php echo e(route('cart.add', $product->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                        class="w-full bg-green-600 text-white text-sm py-2 rounded hover:bg-green-700 transition"
                        aria-label="Add <?php echo e($product->name); ?> to cart">
                        Add to Cart
                    </button>
                </form>

                
                <a href="<?php echo e(route('product.show', $product->id)); ?>"
                   class="block text-center mt-2 text-sm text-blue-500 hover:underline">
                   View Details
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-600">
                No products found
                <?php if(request('tag')): ?> for tag <strong><?php echo e(request('tag')); ?></strong><?php endif; ?>
                <?php if(request('search')): ?> matching "<strong><?php echo e(request('search')); ?></strong>"<?php endif; ?>.
            </p>
        <?php endif; ?>
    </div>

    
    <div class="mt-6">
        <?php echo e($products->withQueryString()->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\kafu\resources\views/products/index.blade.php ENDPATH**/ ?>