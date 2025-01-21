<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['item']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['item']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?> <!-- The $item contains the row data -->

<div class="dropdown">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        Actions
    </button>
    <ul class="dropdown-menu" aria-labelledby="actionsDropdown">
        <!-- Edit Link -->
        <li>
            <?php if(Auth::user()->can('edit stock')): ?>
            <a class="dropdown-item" href="<?php echo e(route('inventory.edit', str_replace('/', '-', $item->stocknumber))); ?>">
                Edit
            </a>
            <?php endif; ?>
        </li>
        <!-- Delete Button -->
        <li>
            <?php if(Auth::user()->can('delete stock')): ?>
            <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($item->stocknumber); ?>">
                Delete
            </button>
            <?php endif; ?>
        </li>
        <!-- Details Link -->
        <li>
            <?php if(Auth::user()->can('view details stock')): ?>
            <a class="dropdown-item" href="<?php echo e(route('inventory.details', str_replace('/', '-', $item->stocknumber))); ?>">
                Details
            </a>
            <?php endif; ?>
        </li>
        <!-- Print QR Code Link -->
        <li>
            <?php if(Auth::user()->can('print qrcode')): ?>
            <a class="dropdown-item" href="<?php echo e(route('generate.barcode', urlencode($item->stocknumber))); ?>" target="_blank">
                Print QR Code
            </a>
            <?php endif; ?>
        </li>
    </ul>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal<?php echo e($item->stocknumber); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo e($item->stocknumber); ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="/inventory/rekap/<?php echo e(str_replace('/', '-', $item->stocknumber)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH P:\app\murni - Copy\inventory\resources\views/components/action.blade.php ENDPATH**/ ?>