

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="header bg-success text-white py-3 text-center">
                <h1>Stock Details</h1>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="main-content bg-white p-4 rounded">
                <h2 class="mb-4">Details of Stock Number: <?php echo e($stock->stocknumber); ?></h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Cabang</th>
                        <td><?php echo e($stock->cabangid); ?></td>
                    </tr>
                    <tr>
                        <th>Departemen</th>
                        <td><?php echo e($stock->departemenid); ?></td>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <td><?php echo e($stock->jenisid); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Beli</th>
                        <td><?php echo e($stock->tanggalbeli); ?></td>
                    </tr>
                    <tr>
                        <th>Nomor Urut</th>
                        <td><?php echo e($stock->nomorurut); ?></td>
                    </tr>
                    <tr>
                        <th>Diperiksa Oleh</th>
                        <td><?php echo e($stock->diperiksaoleh); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Periksa</th>
                        <td><?php echo e($stock->tanggalperiksa); ?></td>
                    </tr>

                    <!-- Additional Details -->
                    <?php if($additionalDetails): ?>
                        <?php $__currentLoopData = $additionalDetails->getAttributes(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th><?php echo e(ucfirst($key)); ?></th>
                                <td><?php echo e($value); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </table>
                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary">Back<-----</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH P:\app\murni - Copy\inventory\resources\views/inventory/Details.blade.php ENDPATH**/ ?>