

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
                <h2 class="mb-4">Edit Stock</h2>
                <?php if($errors->any()): ?>
                    <div class ="alert alert-danger">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><?php echo e($error); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>
                <form action ="/inventory/update/<?php echo e(str_replace('/', '-', $stock->stocknumber)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="form-group row">
                        <label class='col-3' for="cabang">Cabang</label>
                        <input type="number" name="cabang" class="form-control col" id="cabang" value="<?php echo e($stock->cabangid); ?>" required>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="departemen">Departemen</label>
                        <select name="departemen" id="departemen" value = "<?php echo e($stock->departemenid); ?>" class="form-control col" required>
                            <option <?php if($stock->departemenid == 'SLS') { echo 'selected'; } ?> value="SLS">SLS</option>
                            <option <?php if($stock->departemenid == 'SRV') { echo 'selected'; } ?> value="SRV">SRV</option>
                            <option <?php if($stock->departemenid == 'SPR') { echo 'selected'; } ?> value="SPR">SPR</option>
                            <option <?php if($stock->departemenid == 'KWL') { echo 'selected'; } ?> value="KWL">KWL</option>
                            <option <?php if($stock->departemenid == 'OTR') { echo 'selected'; } ?> value="OTR">OTR</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="jenis">Jenis</label>
                        <select name="jenis" id="jenis" value="<?php echo e($stock->jenisid); ?>" class="form-control col">
                            <option <?php if($stock->jenisid == 'MNT') { echo 'selected'; } ?> value="MNT">MNT</option>
                            <option <?php if($stock->jenisid == 'CPU') { echo 'selected'; } ?> value="CPU">CPU</option>
                            <option <?php if($stock->jenisid == 'NBK') { echo 'selected'; } ?> value="NBK">NBK</option>
                            <option <?php if($stock->jenisid == 'UPS') { echo 'selected'; } ?> value="UPS">UPS</option>
                            <option <?php if($stock->jenisid == 'PRN') { echo 'selected'; } ?> value="PRN">PRN</option>
                            <option <?php if($stock->jenisid == 'SWP') { echo 'selected'; } ?> value="SWP">SWP</option>
                            <option <?php if($stock->jenisid == 'SWH') { echo 'selected'; } ?> value="SWH">SWH</option>
                            <option <?php if($stock->jenisid == 'HDE') { echo 'selected'; } ?> value="HDE">HDE</option>
                            <option <?php if($stock->jenisid == 'MDM') { echo 'selected'; } ?> value="MDM">MDM</option>
                            <option <?php if($stock->jenisid == 'OTR') { echo 'selected'; } ?> value="OTR">OTR</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="tanggal_beli">Tanggal Beli</label>
                        <input type="date" name="tanggal_beli" class="form-control col" id="tanggal_beli" value="<?php echo e($stock->tanggalbeli); ?>" required>
                    </div>
                    
                    <div class="form-group row">
                        <label class='col-3' for="nomor_urut">Nomor Urut</label>
                        <input type="number" name="nomor_urut" class="form-control col" id="nomor_urut" value="<?php echo e($stock->nomorurut); ?>" required>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="diperiksa_oleh">Diperiksa Oleh</label>
                        <input type="text" name="diperiksa_oleh" class="form-control col" id="diperiksa_oleh" value="<?php echo e($stock->diperiksaoleh); ?>" required>
                    </div>
                    
                    <div class="form-group row">
                        <label class='col-3' for="tanggal_periksa">Tanggal Periksa</label>
                        <input type="date" name="tanggal_periksa" class="form-control col" id="tanggal_periksa" value="<?php echo e($stock->tanggalperiksa); ?>" required>
                    </div>
                        
                    <table class="table table-bordered">

<script>
    let jenisElement = document.getElementById('jenis');
    if(jenisElement.addEventListener('change', function() {
        const jenis = this.value;
        let additionalFields = '';

        switch(jenis) {
            case 'MNT':
            case 'UPS':
            case 'PRN':
            case 'SWP':
            case 'SWH':
            case 'HDE':
            case 'MDM':
            case 'OTR':
            additionalFields = `
                        <div class="form-group row">
                            <label class='col-3' for="kelompok">kelompok</label>
                            <input type="text" name="kelompok" class="form-control col" value="<?php echo e($data->kelompok ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="merk">Merk</label>
                            <input type="text" name="merk" class="form-control col"  value="<?php echo e($data->merk ?? ''); ?>" required>

                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="user">User </label>
                            <input type="text" name="user" value="<?php echo e($data->user ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="bagian">Bagian</label>
                            <input type="text" name="bagian" value="<?php echo e($data->bagian ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalmasuk">Tanggal Masuk</label>
                            <input type="date" name="tanggalmasuk" value="<?php echo e($data->tanggalmasuk ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                            <input type="date" name="tanggalkeluar" value="<?php echo e($data->tanggalkeluar ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="harga">Harga</label>
                            <input type="number" name="harga"  value=<?php echo e((int)$data->harga ?? ''); ?> class="form-control col">

                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" value="<?php echo e($data->keterangan ?? ''); ?>" class="form-control col">
                        </div>
                    `;
                break; 
            case 'CPU':
                additionalFields = `
                        <div class="form-group row">
                            <label class='col-3' for="kelompok">kelompok</label>
                            <input type="text" name="kelompok" value="<?php echo e($data->kelompok ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Processor</label>
                            <input type="text" name="processor"  value="<?php echo e($data->processor ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">MotherBoard</label>
                            <input type="text" name="motherboard" value="<?php echo e($data->motherboard  ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Memory</label>
                            <input type="text" name="memory"  value="<?php echo e($data->memory ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Harddisk</label>
                            <input type="text" name="harddisk"  value="<?php echo e($data->harddisk  ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Lan Card</label>
                            <input type="text" name="lancard"   value="<?php echo e($data->lancard ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">VGA Card</label>
                            <input type="text" name="vgacard"  value="<?php echo e($data->vgacard ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Mouse</label>
                            <input type="text" name="mouse"   value="<?php echo e($data->mouse ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Keyboard</label>
                            <input type="text" name="keyboard"   value="<?php echo e($data->keyboard  ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">OS</label>
                            <input type="text" name="os"   value="<?php echo e($data->os  ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Anti Virus</label>
                            <input type="text" name="antivirus"    value="<?php echo e($data->antivirus  ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Office</label>
                            <input type="text" name="office" value="<?php echo e($data->office  ?? ''); ?>" class="form-control col " required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">IP</label>
                            <input type="text" name="ip"  value="<?php echo e($data->ip   ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">User </label>
                            <input type="text" name="user"   value="<?php echo e($data->user ?? ''); ?>" class="form-control col" required>
                        <div class="form-group row">
                            <label class='col-3' for="bagian">Bagian</label>
                            <input type="text" name="bagian" value="<?php echo e($data->bagian ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Exp. Anti Virus</label>
                            <input type="date" name="expantivirus"   value="<?php echo e($data->expantivirus  ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Tanggal Masuk</label>
                            <input type="date" name="tanggalmasuk"     value="<?php echo e($data->tanggalmasuk  ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                            <input type="date" name="tanggalkeluar" value="<?php echo e($data->tanggalkeluar   ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Harga</label>
                            <input type="number" name="harga" value="<?php echo e($data->harga   ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Keterangan</label>
                            <input type="text" name="keterangan" value="<?php echo e($data->keterangan   ?? ''); ?>" class="form-control col">
                        </div>
                    `;
                break;
            case 'NBK':
                additionalFields = `
                        <div class="form-group row">
                            <label class='col-3' for="kelompok">kelompok</label>
                            <input type="text" name="kelompok"  value="<?php echo e($data->kelompok ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Processor</label>
                            <input type="text" name="processor"  value="<?php echo e($data->processor ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Merk</label>
                            <input type="text" name="merk" value="<?php echo e($data->merk  ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Memory</label>
                            <input type="text" name="memory" value="<?php echo e($data->memory   ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Harddisk</label>
                            <input type="text" name="harddisk" value="<?php echo e($data->harddisk    ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">DVD-CD-RW</label>
                            <input type="text" name="dvd_cd_rw" value="<?php echo e($data->dvd_cd_rw    ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Layar</label>
                            <input type="text" name="layar" value="<?php echo e($data->layar    ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Wifi</label>
                            <input type="text" name="wifi" value="<?php echo e($data->wifi    ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Webcam</label>
                            <input type="text" name="webcam" value="<?php echo e($data->webcam     ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Tas</label>
                            <input type="text" name="tas" value="<?php echo e($data->tas ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">OS</label>
                            <input type="text" name="os" value="<?php echo e($data->os ?? ''); ?>" class="form-control  col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Anti Virus</label>
                            <input type="text" name="antivirus"  value="<?php echo e($data->antivirus ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Office</label>
                            <input type="text" name="office"  value="<?php echo e($data->office  ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">IP</label>
                            <input type="text" name="ip" value="<?php echo e($data->ip  ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">User </label>
                            <input type="text" name="user" value="<?php echo e($data->user ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="bagian">Bagian</label>
                            <input type="text" name="bagian" value="<?php echo e($data->bagian ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Tanggal Masuk</label>
                            <input type="date" name="tanggalmasuk" value="<?php echo e($data->tanggalmasuk ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                            <input type="date" name="tanggalkeluar" value="<?php echo e($data->tanggalkeluar  ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Harga</label>
                            <input type="number" name="harga" value="<?php echo e($data->harga  ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Keterangan</label>
                            <input type="text" name="keterangan" value="<?php echo e($data->keterangan  ?? ''); ?>" class="form-control col">
                        </div>
                    `;
                break;
        }
        
        document.getElementById('additional-inputs').innerHTML = additionalFields;
    }))

    console.log('ok');
    
    document.addEventListener('DOMContentLoaded', function() {
        const stock=<?= $stock ?>;
        const jenisselected=stock.jenisid

        let additionalFields = '';
        if  (jenisselected == 'MNT'|| jenisselected == 'UPS' || jenisselected == 'PRN' || jenisselected == 'SWP' || jenisselected == 'SWH' 
        || jenisselected == 'HDE' || jenisselected == 'MDM' || jenisselected == 'OTR' ) {
            additionalFields = `
                        <div class="form-group row">
                            <label class='col-3' for="kelompok">kelompok</label>
                            <input type="text" name="kelompok" class="form-control col" value="<?php echo e($data->kelompok ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="merk">Merk</label>
                            <input type="text" name="merk" class="form-control col"  value="<?php echo e($data->merk ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="user">User </label>
                            <input type="text" name="user" value="<?php echo e($data->user ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="bagian">Bagian</label>
                            <input type="text" name="bagian" value="<?php echo e($data->bagian ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalmasuk">Tanggal Masuk</label>
                            <input type="date" name="tanggalmasuk" value="<?php echo e($data->tanggalmasuk  ?? ''); ?>" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                            <input type="date" name="tanggalkeluar" value="<?php echo e($data->tanggalkeluar   ?? ''); ?>" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="harga">Harga</label>
                            <input type="number" name="harga"  value=<?php echo e((int)$data->harga ?? ''); ?> class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" value="<?php echo e($data->keterangan   ?? ''); ?>" class="form-control col">
                        </div>
                    `;
        } else if (jenisselected == 'CPU') {
            additionalFields = `
                        <div class="form-group row">
                            <label class='col-3' for="kelompok">kelompok</label>
                            <input type="text" name="kelompok" class="form-control col" value="<?php echo e($data->kelompok  ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Processor</label>
                            <input type="text" name="processor" class="form-control col" value="<?php echo e($data->processor ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label for class='col-3' for="motherboard">Motherboard</label>
                            <input type="text" name="motherboard" class="form-control col" value="<?php echo e($data->motherboard ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="memory">Memory</label>
                            <input type="text" name="memory" class="form-control col" value="<?php echo e($data->memory ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="harddisk">Harddisk</label>
                            <input type="text" name="harddisk" class="form-control  col" value="<?php echo e($data->harddisk  ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3'  for="lancard">Lan Card</label>
                            <input type="text" name="lancard" class="form-control col" value="<?php echo e($data->lancard   ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="vgacard">VGA Card</label>
                            <input type="text" name="vgacard" class="form-control col" value="<?php echo e($data->vgacard   ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="mouse">Mouse</label>
                            <input type="text" name="mouse" class="form-control col" value="<?php echo e($data->mouse ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="keyboard">Keyboard</label>
                            <input type="text" name="keyboard" class="form-control col" value="<?php echo e($data->keyboard  ?? ''); ?>" required }}">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="os">OS</label>
                            <input type="text" name="os" class="form-control col" value="<?php echo e($data->os  ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="antivirus">Anti Virus</label>
                            <input type="text" name="antivirus" class="form-control col" value="<?php echo e($data->antivirus  ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="office">Office</label>
                            <input type="text" name="office" class="form-control col" value="<?php echo e($data->office  ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="ip">IP</label>
                            <input type="text" name="ip" class="form-control col" value="<?php echo e($data->ip  ?? ''); ?>" >
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="user">User</label>
                            <input type="text" name="user" class="form-control col" value="<?php echo e($data->user   ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="bagian">Bagian</label>
                            <input type="text" name="bagian" class="form-control col" value="<?php echo e($data->bagian  ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="expantivirus">Exp. Anti Virus</label>
                            <input type="date" name="expantivirus" class="form-control col" value="<?php echo e($data->expantivirus  ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label  for="tanggalmasuk">Tanggal Masuk</label>
                            <input type="date" name="tanggalmasuk" class="form-control col" value="<?php echo e($data->tanggalmasuk   ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                            <input type="date" name="tanggalkeluar" class="form-control c" value="<?php echo e($data->tanggalkeluar   ?? ''); ?>">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="harga">Harga</label>
                            <input type="number" name="harga" class="form-control col" value="<?php echo e($data->harga   ?? ''); ?>">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="form-control col"><?php echo e($data->keterangan   ?? ''); ?></textarea>
                        </div>
                        `;
            
        } else if (jenisselected == 'NBK') {
            additionalFields = `
                        <div class="form-group row">
                            <label class='col-3' for="kelompok">kelompok</label>
                            <input type="text" name="kelompok" class="form-control col" value="<?php echo e($data->kelompok   ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Processor</label>
                            <input type="text" name="processor" class="form-control col" value="<?php echo e($data->processor    ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="merk">Merk</label>
                            <input type="text" name="merk" class="form-control col" value="<?php echo e($data->merk    ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="memory">Memory</label>
                            <input type="text" name="memory" class="form-control c" value="<?php echo e($data->memory ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="harddisk">Harddisk</label>
                            <input type="text" name="harddisk" class="form-control col" value="<?php echo e($data->harddisk  ?? ''); ?>">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="dvd_cd_rw">DVD/CD/RW</label>
                            <input type="text" name="dvd_cd_rw" class="form-control col" value="<?php echo e($data->dvd_cd_rw   ?? ''); ?>">

                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="layar">Layar</label>
                            <input type="text" name="layar" class="form-control col"  value="<?php echo e($data->layar ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="wifi">WiFi</label>
                            <input type="text" name="wifi" class="form-control col" value="<?php echo e($data->wifi  ?? ''); ?>">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="webcam">Webcam</label>
                            <input type="text" name="webcam" class="form-control col" value="<?php echo e($data->webcam   ?? ''); ?>">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tas">Tas</label> 
                            <input type="text" name="tas" class="form-control col" value="<?php echo e($data->tas  ?? ''); ?>">
                        </div>
                        <div class="form-group row">
                            <label  class='col-3' for="os">OS</label>
                            <input type="text" name="os" class="form-control col" value="<?php echo e($data->os  ?? ''); ?>">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="antivirus">Anti Virus</label>
                            <input type="text" name="antivirus" class="form-control col" value="<?php echo e($data->antivirus   ?? ''); ?>">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="office">Office</label>
                            <input type="office" name="note" class="form-control col" value="<?php echo e($data->office   ?? ''); ?>">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="ip">IP</label>
                            <input type="text" name="ip" class="form-control col" value="<?php echo e($data->ip  ?? ''); ?>">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="user">User</label>
                            <input type="text" name="user" class="form-control col" value="<?php echo e($data->user  ?? ''); ?>">
                        </div>
                        <div  class="form-group row">
                            <label class='col-3' for="bagian">Bagian</label>
                            <input type="text" name="bagian" class="form-control col" value="<?php echo e($data->bagian  ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalmasuk">Tanggal Masuk</label>
                            <input type="date" name="tanggalmasuk" class="form-control col" value="<?php echo e($data->tanggalmasuk  ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                            <input type="date" name="tanggalkeluar" class="form-control" value="<?php echo e($data->tanggalkeluar   ?? ''); ?>">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="harga">Harga</label>
                            <input type="number" name="harga" class="form-control col" value="<?php echo e($data->harga   ?? ''); ?>" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="form-control col"><?php echo e($data->keterangan   ?? ''); ?></textarea>

                        </div>
                         `;
        }
        document.getElementById('additional-inputs').innerHTML = additionalFields;
    })
 
    </script>
    <div id="additional-inputs"></div>
					</table>
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary">Back<-----</a>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH P:\app\murni - Copy\inventory\resources\views/inventory/Edit.blade.php ENDPATH**/ ?>