

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
                <h2 class="mb-4">CPU List</h2>
                <!-- Filter Button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                    Open Filters
                </button>

                <!-- Include the Modal Component -->
                <?php if (isset($component)) { $__componentOriginal8a51fe4f30717561432884ea58108996 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8a51fe4f30717561432884ea58108996 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.filter-modal','data' => ['route' => request()->url()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filter-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->url())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8a51fe4f30717561432884ea58108996)): ?>
<?php $attributes = $__attributesOriginal8a51fe4f30717561432884ea58108996; ?>
<?php unset($__attributesOriginal8a51fe4f30717561432884ea58108996); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8a51fe4f30717561432884ea58108996)): ?>
<?php $component = $__componentOriginal8a51fe4f30717561432884ea58108996; ?>
<?php unset($__componentOriginal8a51fe4f30717561432884ea58108996); ?>
<?php endif; ?>

                <a href="<?php echo e(route('inventory.komputer')); ?>" class="btn btn-secondary">
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
                                <th>Kelompok</th>
                                <th>Processor</th>
                                <th>Motherboard</th>
                                <th>Memory</th>
                                <th>Harddisk</th>
                                <th>Lan Card</th>
                                <th>VGA Card</th>
                                <th>Mouse</th>
                                <th>Keyboard</th>
                                <th>OS</th>
                                <th>Anti Virus</th>
                                <th>Office</th>
                                <th>IP</th>
                                <th>User</th>
                                <th>Departemen</th>
                                <th>Bagian</th>
                                <th>Exp. Anti Virus</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Harga</th>
                                <th>Keterangan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $Komputer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration + ($Komputer->currentPage() - 1) * $Komputer->perPage()); ?></td>
                                    <td><?php echo e($item->stocknumber); ?></td>
                                    <td><?php echo e($item->kelompok); ?></td>
                                    <td><?php echo e($item->processor); ?></td>
                                    <td><?php echo e($item->motherboard); ?></td>
                                    <td><?php echo e($item->memory); ?></td>
                                    <td><?php echo e($item->harddisk); ?></td>
                                    <td><?php echo e($item->lancard); ?></td>
                                    <td><?php echo e($item->vgacard); ?></td>
                                    <td><?php echo e($item->mouse); ?></td>
                                    <td><?php echo e($item->keyboard); ?></td>
                                    <td><?php echo e($item->os); ?></td>
                                    <td><?php echo e($item->antivirus); ?></td>
                                    <td><?php echo e($item->office); ?></td>
                                    <td><?php echo e($item->ip); ?></td>
                                    <td><?php echo e($item->user); ?></td>
                                    <td><?php echo e($item->departemenid); ?></td>
                                    <td><?php echo e($item->bagian); ?></td>
                                    <td><?php echo e($item->expantivirus); ?></td>
                                    <td><?php echo e($item->tanggalmasuk); ?></td>
                                    <td><?php echo e($item->tanggalkeluar); ?></td>
                                    <td><?php echo e($item->keterangan); ?></td>
                                    <td><?php echo e($item->harga); ?></td>
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
                 <div class="d-flex justify-content-center mt-3">
                    <?php echo e($Komputer->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH P:\app\murni - Copy\inventory\resources\views/inventory/Komputer.blade.php ENDPATH**/ ?>