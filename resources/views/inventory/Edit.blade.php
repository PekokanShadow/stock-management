@extends('layouts.app')

@section('content')
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
       <x-sidebar />
       
        <!-- Main Content (right) -->
        <div class="col-md-9">
            <div class="main-content bg-white p-4 rounded">
                <h2 class="mb-4">Edit Stock</h2>
                @if($errors->any())
                    <div class ="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action ="/inventory/update/{{ str_replace('/', '-', $stock->stocknumber) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label class='col-3' for="cabang">Cabang</label>
                        <input type="number" name="cabang" class="form-control col" id="cabang" value="{{ $stock->cabangid }}" required>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="departemen">Departemen</label>
                        <select name="departemen" id="departemen" value = "{{ $stock->departemenid }}" class="form-control col" required>
                            <option <?php if($stock->departemenid == 'SLS') { echo 'selected'; } ?> value="SLS">SLS</option>
                            <option <?php if($stock->departemenid == 'SRV') { echo 'selected'; } ?> value="SRV">SRV</option>
                            <option <?php if($stock->departemenid == 'SPR') { echo 'selected'; } ?> value="SPR">SPR</option>
                            <option <?php if($stock->departemenid == 'KWL') { echo 'selected'; } ?> value="KWL">KWL</option>
                            <option <?php if($stock->departemenid == 'OTR') { echo 'selected'; } ?> value="OTR">OTR</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="jenis">Jenis</label>
                        <select name="jenis" id="jenis" value="{{ $stock->jenisid }}" class="form-control col">
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
                        <input type="date" name="tanggal_beli" class="form-control col" id="tanggal_beli" value="{{ $stock->tanggalbeli }}" required>
                    </div>
                    
                    <div class="form-group row">
                        <label class='col-3' for="nomor_urut">Nomor Urut</label>
                        <input type="number" name="nomor_urut" class="form-control col" id="nomor_urut" value="{{ $stock->nomorurut }}" required>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="diperiksa_oleh">Diperiksa Oleh</label>
                        <input type="text" name="diperiksa_oleh" class="form-control col" id="diperiksa_oleh" value="{{ $stock->diperiksaoleh }}" required>
                    </div>
                    
                    <div class="form-group row">
                        <label class='col-3' for="tanggal_periksa">Tanggal Periksa</label>
                        <input type="date" name="tanggal_periksa" class="form-control col" id="tanggal_periksa" value="{{ $stock->tanggalperiksa }}" required>
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
                            <input type="text" name="kelompok" class="form-control col" value="{{ $data->kelompok ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="merk">Merk</label>
                            <input type="text" name="merk" class="form-control col"  value="{{ $data->merk ?? '' }}" required>

                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="user">User </label>
                            <input type="text" name="user" value="{{ $data->user ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="bagian">Bagian</label>
                            <input type="text" name="bagian" value="{{ $data->bagian ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalmasuk">Tanggal Masuk</label>
                            <input type="date" name="tanggalmasuk" value="{{ $data->tanggalmasuk ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                            <input type="date" name="tanggalkeluar" value="{{ $data->tanggalkeluar ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="harga">Harga</label>
                            <input type="number" name="harga"  value={{ (int)$data->harga ?? '' }} class="form-control col">

                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" value="{{ $data->keterangan ?? '' }}" class="form-control col">
                        </div>
                    `;
                break; 
            case 'CPU':
                additionalFields = `
                        <div class="form-group row">
                            <label class='col-3' for="kelompok">kelompok</label>
                            <input type="text" name="kelompok" value="{{ $data->kelompok ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Processor</label>
                            <input type="text" name="processor"  value="{{ $data->processor ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">MotherBoard</label>
                            <input type="text" name="motherboard" value="{{ $data->motherboard  ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Memory</label>
                            <input type="text" name="memory"  value="{{ $data->memory ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Harddisk</label>
                            <input type="text" name="harddisk"  value="{{ $data->harddisk  ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Lan Card</label>
                            <input type="text" name="lancard"   value="{{ $data->lancard ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">VGA Card</label>
                            <input type="text" name="vgacard"  value="{{ $data->vgacard ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Mouse</label>
                            <input type="text" name="mouse"   value="{{ $data->mouse ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Keyboard</label>
                            <input type="text" name="keyboard"   value="{{ $data->keyboard  ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">OS</label>
                            <input type="text" name="os"   value="{{ $data->os  ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Anti Virus</label>
                            <input type="text" name="antivirus"    value="{{ $data->antivirus  ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Office</label>
                            <input type="text" name="office" value="{{ $data->office  ?? '' }}" class="form-control col " required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">IP</label>
                            <input type="text" name="ip"  value="{{ $data->ip   ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">User </label>
                            <input type="text" name="user"   value="{{ $data->user ?? '' }}" class="form-control col" required>
                        <div class="form-group row">
                            <label class='col-3' for="bagian">Bagian</label>
                            <input type="text" name="bagian" value="{{ $data->bagian ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Exp. Anti Virus</label>
                            <input type="date" name="expantivirus"   value="{{ $data->expantivirus  ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Tanggal Masuk</label>
                            <input type="date" name="tanggalmasuk"     value="{{ $data->tanggalmasuk  ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                            <input type="date" name="tanggalkeluar" value="{{ $data->tanggalkeluar   ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Harga</label>
                            <input type="number" name="harga" value="{{ $data->harga   ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Keterangan</label>
                            <input type="text" name="keterangan" value="{{ $data->keterangan   ?? '' }}" class="form-control col">
                        </div>
                    `;
                break;
            case 'NBK':
                additionalFields = `
                        <div class="form-group row">
                            <label class='col-3' for="kelompok">kelompok</label>
                            <input type="text" name="kelompok"  value="{{ $data->kelompok ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Processor</label>
                            <input type="text" name="processor"  value="{{ $data->processor ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Merk</label>
                            <input type="text" name="merk" value="{{ $data->merk  ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Memory</label>
                            <input type="text" name="memory" value="{{ $data->memory   ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Harddisk</label>
                            <input type="text" name="harddisk" value="{{ $data->harddisk    ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">DVD-CD-RW</label>
                            <input type="text" name="dvd_cd_rw" value="{{ $data->dvd_cd_rw    ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Layar</label>
                            <input type="text" name="layar" value="{{ $data->layar    ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Wifi</label>
                            <input type="text" name="wifi" value="{{ $data->wifi    ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Webcam</label>
                            <input type="text" name="webcam" value="{{ $data->webcam     ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Tas</label>
                            <input type="text" name="tas" value="{{ $data->tas ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">OS</label>
                            <input type="text" name="os" value="{{ $data->os ?? '' }}" class="form-control  col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Anti Virus</label>
                            <input type="text" name="antivirus"  value="{{ $data->antivirus ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Office</label>
                            <input type="text" name="office"  value="{{ $data->office  ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">IP</label>
                            <input type="text" name="ip" value="{{ $data->ip  ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">User </label>
                            <input type="text" name="user" value="{{ $data->user ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="bagian">Bagian</label>
                            <input type="text" name="bagian" value="{{ $data->bagian ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Tanggal Masuk</label>
                            <input type="date" name="tanggalmasuk" value="{{ $data->tanggalmasuk ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                            <input type="date" name="tanggalkeluar" value="{{ $data->tanggalkeluar  ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Harga</label>
                            <input type="number" name="harga" value="{{ $data->harga  ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Keterangan</label>
                            <input type="text" name="keterangan" value="{{ $data->keterangan  ?? '' }}" class="form-control col">
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
                            <input type="text" name="kelompok" class="form-control col" value="{{ $data->kelompok ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="merk">Merk</label>
                            <input type="text" name="merk" class="form-control col"  value="{{ $data->merk ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="user">User </label>
                            <input type="text" name="user" value="{{ $data->user ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="bagian">Bagian</label>
                            <input type="text" name="bagian" value="{{ $data->bagian ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalmasuk">Tanggal Masuk</label>
                            <input type="date" name="tanggalmasuk" value="{{ $data->tanggalmasuk  ?? '' }}" class="form-control col" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                            <input type="date" name="tanggalkeluar" value="{{ $data->tanggalkeluar   ?? '' }}" class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="harga">Harga</label>
                            <input type="number" name="harga"  value={{ (int)$data->harga ?? '' }} class="form-control col">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" value="{{ $data->keterangan   ?? '' }}" class="form-control col">
                        </div>
                    `;
        } else if (jenisselected == 'CPU') {
            additionalFields = `
                        <div class="form-group row">
                            <label class='col-3' for="kelompok">kelompok</label>
                            <input type="text" name="kelompok" class="form-control col" value="{{ $data->kelompok  ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Processor</label>
                            <input type="text" name="processor" class="form-control col" value="{{ $data->processor ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label for class='col-3' for="motherboard">Motherboard</label>
                            <input type="text" name="motherboard" class="form-control col" value="{{ $data->motherboard ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="memory">Memory</label>
                            <input type="text" name="memory" class="form-control col" value="{{ $data->memory ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="harddisk">Harddisk</label>
                            <input type="text" name="harddisk" class="form-control  col" value="{{ $data->harddisk  ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3'  for="lancard">Lan Card</label>
                            <input type="text" name="lancard" class="form-control col" value="{{ $data->lancard   ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="vgacard">VGA Card</label>
                            <input type="text" name="vgacard" class="form-control col" value="{{ $data->vgacard   ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="mouse">Mouse</label>
                            <input type="text" name="mouse" class="form-control col" value="{{ $data->mouse ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="keyboard">Keyboard</label>
                            <input type="text" name="keyboard" class="form-control col" value="{{ $data->keyboard  ?? '' }}" required }}">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="os">OS</label>
                            <input type="text" name="os" class="form-control col" value="{{ $data->os  ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="antivirus">Anti Virus</label>
                            <input type="text" name="antivirus" class="form-control col" value="{{ $data->antivirus  ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="office">Office</label>
                            <input type="text" name="office" class="form-control col" value="{{ $data->office  ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="ip">IP</label>
                            <input type="text" name="ip" class="form-control col" value="{{ $data->ip  ?? '' }}" >
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="user">User</label>
                            <input type="text" name="user" class="form-control col" value="{{ $data->user   ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="bagian">Bagian</label>
                            <input type="text" name="bagian" class="form-control col" value="{{ $data->bagian  ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="expantivirus">Exp. Anti Virus</label>
                            <input type="date" name="expantivirus" class="form-control col" value="{{ $data->expantivirus  ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label  for="tanggalmasuk">Tanggal Masuk</label>
                            <input type="date" name="tanggalmasuk" class="form-control col" value="{{ $data->tanggalmasuk   ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                            <input type="date" name="tanggalkeluar" class="form-control c" value="{{ $data->tanggalkeluar   ?? '' }}">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="harga">Harga</label>
                            <input type="number" name="harga" class="form-control col" value="{{ $data->harga   ?? '' }}">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="form-control col">{{ $data->keterangan   ?? '' }}</textarea>
                        </div>
                        `;
            
        } else if (jenisselected == 'NBK') {
            additionalFields = `
                        <div class="form-group row">
                            <label class='col-3' for="kelompok">kelompok</label>
                            <input type="text" name="kelompok" class="form-control col" value="{{ $data->kelompok   ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="processor">Processor</label>
                            <input type="text" name="processor" class="form-control col" value="{{ $data->processor    ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="merk">Merk</label>
                            <input type="text" name="merk" class="form-control col" value="{{ $data->merk    ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="memory">Memory</label>
                            <input type="text" name="memory" class="form-control c" value="{{ $data->memory ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="harddisk">Harddisk</label>
                            <input type="text" name="harddisk" class="form-control col" value="{{ $data->harddisk  ?? '' }}">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="dvd_cd_rw">DVD/CD/RW</label>
                            <input type="text" name="dvd_cd_rw" class="form-control col" value="{{ $data->dvd_cd_rw   ?? '' }}">

                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="layar">Layar</label>
                            <input type="text" name="layar" class="form-control col"  value="{{ $data->layar ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="wifi">WiFi</label>
                            <input type="text" name="wifi" class="form-control col" value="{{ $data->wifi  ?? '' }}">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="webcam">Webcam</label>
                            <input type="text" name="webcam" class="form-control col" value="{{ $data->webcam   ?? '' }}">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tas">Tas</label> 
                            <input type="text" name="tas" class="form-control col" value="{{ $data->tas  ?? '' }}">
                        </div>
                        <div class="form-group row">
                            <label  class='col-3' for="os">OS</label>
                            <input type="text" name="os" class="form-control col" value="{{ $data->os  ?? '' }}">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="antivirus">Anti Virus</label>
                            <input type="text" name="antivirus" class="form-control col" value="{{ $data->antivirus   ?? '' }}">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="office">Office</label>
                            <input type="office" name="note" class="form-control col" value="{{ $data->office   ?? '' }}">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="ip">IP</label>
                            <input type="text" name="ip" class="form-control col" value="{{ $data->ip  ?? '' }}">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="user">User</label>
                            <input type="text" name="user" class="form-control col" value="{{ $data->user  ?? '' }}">
                        </div>
                        <div  class="form-group row">
                            <label class='col-3' for="bagian">Bagian</label>
                            <input type="text" name="bagian" class="form-control col" value="{{ $data->bagian  ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalmasuk">Tanggal Masuk</label>
                            <input type="date" name="tanggalmasuk" class="form-control col" value="{{ $data->tanggalmasuk  ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                            <input type="date" name="tanggalkeluar" class="form-control" value="{{ $data->tanggalkeluar   ?? '' }}">
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="harga">Harga</label>
                            <input type="number" name="harga" class="form-control col" value="{{ $data->harga   ?? '' }}" required>
                        </div>
                        <div class="form-group row">
                            <label class='col-3' for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="form-control col">{{ $data->keterangan   ?? '' }}</textarea>

                        </div>
                         `;
        }
        document.getElementById('additional-inputs').innerHTML = additionalFields;
    })
 
    </script>
    <div id="additional-inputs"></div>
					</table>
                    <a href="{{ url()->previous()  }}" class="btn btn-secondary">Back<-----</a>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
</div>
@endsection