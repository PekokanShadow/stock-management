<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['route']));

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

foreach (array_filter((['route']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?> <!-- Accept a dynamic route -->

<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" action="<?php echo e($route); ?>">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date(Tanggal Masuk)</label>
                        <input 
                            type="date" 
                            id="start_date" 
                            name="start_date" 
                            class="form-control" 
                            value="<?php echo e(request('start_date')); ?>"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date(Tanggal Masuk)</label>
                        <input 
                            type="date" 
                            id="end_date" 
                            name="end_date" 
                            class="form-control" 
                            value="<?php echo e(request('end_date')); ?>"
                        >
                    </div>

                    <div class="mb-3">
                        <label for="cabangid" class="form-label">Nomor Cabang</label>
                        <input 
                            type="number" 
                            id="cabangid" 
                            name="cabangid" 
                            class="form-control" 
                            value="<?php echo e(request('cabangid')); ?>"
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="departemenid">Departemen</label>
                        <select name="departemenid" id="departemenid" class="form-control">
                            <option disabled selected value="">Pilih Departemen</option>
                            <option value="SLS">SLS (Sales)</option>
                            <option value="SRV">SRV (Service)</option>
                            <option value="SPR">SPR (Spare Part)</option>
                            <option value="KWL">KWL (Kanwil)</option>
                            <option value="OTR">OTR (Other)</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                    <script>
                        document.getElementById('start_date').addEventListener('input', function() {
                            const startDate = this.value; // Get the value of start_date
                            const endDateInput = document.getElementById('end_date');
                    
                            // Set the end_date to the same value as start_date
                            endDateInput.value = startDate;
                        });
                    </script>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH P:\app\murni - Copy\inventory\resources\views/components/filter-modal.blade.php ENDPATH**/ ?>