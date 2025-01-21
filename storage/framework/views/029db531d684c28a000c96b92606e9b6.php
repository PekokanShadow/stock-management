

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="header bg-primary text-white py-3 text-center">
                <h1>Manage Roles</h1>
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
        <!-- Main Content -->
        <div class="col-md-9">
            <div class="main-content bg-white p-4 rounded">                
                
                <?php if(Auth::user()->can('create role' )): ?>
                <!-- Create New Role Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Role List</h2>
                    <a href="<?php echo e(route('roles.create')); ?>" class="btn btn-success">Create New Role</a>
                </div>
                <?php endif; ?>
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                <!-- Role Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($role->name); ?></td>
                                    <td>
                                        <?php echo e($role->permissions->pluck('name')->join(', ')); ?>

                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown">
                                                <?php if(Auth::user()->can('edit role')): ?>
                                                <li>
                                                    <a class="dropdown-item" href="<?php echo e(route('roles.edit', $role->id)); ?>">Edit</a>
                                                </li>
                                                <?php endif; ?>
                                                <?php if(Auth::user()->can('delete role')): ?>
                                                <li>
                                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($role->id); ?>">Delete</button>
                                                </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                        
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal<?php echo e($role->id); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo e($role->name); ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                Are you sure you want to delete the role <strong><?php echo e($role->name); ?></strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action="<?php echo e(route('roles.destroy', $role->id)); ?>" method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                    <div class="d-flex justify-content-center mt-3">
                        <?php echo e($roles->links()); ?>

                    </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH P:\app\murni - Copy\inventory\resources\views/profile/role.blade.php ENDPATH**/ ?>