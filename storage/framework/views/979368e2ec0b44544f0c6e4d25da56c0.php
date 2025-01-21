

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="header bg-success text-white py-3 text-center">
                <h1>Stock Management</h1>
            </div>
        </div>
    </div>

    <!-- Sidebar and Main Content -->
    <div class="row mt-3">
       <!-- Include Sidebar Component -->
       <?php if (isset($component)) { $__componentOriginal2880b66d47486b4bfeaf519598a469d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2880b66d47486b4bfeaf519598a469d6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2880b66d47486b4bfeaf519598a469d6)): ?>
<?php $attributes = $__attributesOriginal2880b66d47486b4bfeaf519598a469d6; ?>
<?php unset($__attributesOriginal2880b66d47486b4bfeaf519598a469d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2880b66d47486b4bfeaf519598a469d6)): ?>
<?php $component = $__componentOriginal2880b66d47486b4bfeaf519598a469d6; ?>
<?php unset($__componentOriginal2880b66d47486b4bfeaf519598a469d6); ?>
<?php endif; ?>

        <!-- Main Content (right) -->
        <div class="col-md-9">
            <div class="main-content bg-white p-4 rounded">
                <h2 class="mb-4">Stock List</h2>

                <!-- Filter Button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                    Open Filters
                </button>
                
                <!-- Include the Modal Component -->
                <?php if (isset($component)) { $__componentOriginal3533fa6ef6aa2fc30d462a414ad1f41a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3533fa6ef6aa2fc30d462a414ad1f41a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.filter2-modal','data' => ['route' => request()->url()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filter2-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->url())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3533fa6ef6aa2fc30d462a414ad1f41a)): ?>
<?php $attributes = $__attributesOriginal3533fa6ef6aa2fc30d462a414ad1f41a; ?>
<?php unset($__attributesOriginal3533fa6ef6aa2fc30d462a414ad1f41a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3533fa6ef6aa2fc30d462a414ad1f41a)): ?>
<?php $component = $__componentOriginal3533fa6ef6aa2fc30d462a414ad1f41a; ?>
<?php unset($__componentOriginal3533fa6ef6aa2fc30d462a414ad1f41a); ?>
<?php endif; ?>
                
                <a href="<?php echo e(route('inventory.rekap')); ?>" class="btn btn-secondary">
                    Clear Filters
                </a>

                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Stock Number</th>
                                <th>Cabang</th>
                                <th>Departemen</th>
                                <th>Jenis</th>
                                <th>Tanggal Beli</th>
                                <th>Nomor Urut</th>
                                <th>Diperiksa Oleh</th>
                                <th>Tanggal Periksa</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $Stock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <!-- Calculate index based on pagination -->
                                    <td><?php echo e($loop->iteration + ($Stock->currentPage() - 1) * $Stock->perPage()); ?></td>
                                    <td><?php echo e($item->stocknumber); ?></td>
                                    <td><?php echo e($item->cabangid); ?></td>
                                    <td><?php echo e($item->departemenid); ?></td>
                                    <td><?php echo e($item->jenisid); ?></td>
                                    <td><?php echo e($item->tanggalbeli); ?></td>
                                    <td><?php echo e($item->nomorurut); ?></td>
                                    <td><?php echo e($item->diperiksaoleh); ?></td>
                                    <td><?php echo e($item->tanggalperiksa); ?></td>
                                    <td>
                                        <?php if (isset($component)) { $__componentOriginald1edfc4ac0484275d401a94660eac324 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald1edfc4ac0484275d401a94660eac324 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.action','data' => ['item' => $item]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('action'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['item' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald1edfc4ac0484275d401a94660eac324)): ?>
<?php $attributes = $__attributesOriginald1edfc4ac0484275d401a94660eac324; ?>
<?php unset($__attributesOriginald1edfc4ac0484275d401a94660eac324); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald1edfc4ac0484275d401a94660eac324)): ?>
<?php $component = $__componentOriginald1edfc4ac0484275d401a94660eac324; ?>
<?php unset($__componentOriginald1edfc4ac0484275d401a94660eac324); ?>
<?php endif; ?>
                                    </td>  
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    <?php echo e($Stock->links()); ?>

                </div>
                
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH P:\app\murni - Copy\inventory\resources\views/inventory/Rekap.blade.php ENDPATH**/ ?>