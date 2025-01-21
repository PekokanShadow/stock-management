@extends('layouts.app') @section('content')
<div class="container-fluid">
	<!-- Header Section -->
	<div class="row">
		<div class="col-12">
			<div class="header bg-success text-white py-3 text-center">
				<h1>Stock Management</h1> </div>
		</div>
	</div>
	<!-- Sidebar and Main Content -->
	<div class="row mt-3">
		        <!-- Include Sidebar Component -->
                <x-sidebar />
		<!-- Main Content (right) -->
		<div class="col-md-9">
			<div class="main-content bg-white p-4 rounded">
				<h2 class="mb-4">Input Inventory Data</h2>
                @if($errors->any())
                    <div class ="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @if (session('success'))
                    <div class ="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
				<form method="POST" action="{{ route('inventory.store') }}"> 
                    @csrf
                    <div class="form-group row">
                        <label class='col-3' for="cabang">Cabang</label>
                        <input type="number" name="cabang" class="form-control col" id="cabang" required>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="departemen">Departemen</label>
                        <select name="departemen" id="departemen" class="form-control col" required>
                            <option disabled selected value="">Pilih Departemen</option>
                            <option value="SLS">SLS (Sales)</option>
                            <option value="SRV">SRV (Service)</option>
                            <option value="SPR">SPR (Spare Part)</option>
                            <option value="KWL">KWL (Kanwil)</option>
                            <option value="OTR">OTR (Other)</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="jenis">Jenis</label>
                        <select name="jenis" id="jenis" class="form-control col" required>
                            <option disabled selected value="">Pilih Jenis</option>
                                    <option value="MNT">MNT (Monitor)</option>
                                    <option value="CPU">CPU (Central Processing Unit)</option>
                                    <option value="NBK">NBK (Notebook)</option>
                                    <option value="UPS">UPS (Uninterruptible Power Supply)</option>
                                    <option value="PRN">PRN (Printer)</option>
                                    <option value="SWP">SWP (Switch - Power)</option>
                                    <option value="SWH">SWH (Switch - Hub)</option>
                                    <option value="HDE">HDE (Hard Disk External)</option>
                                    <option value="MDM">MDM (Modem)</option>
                                    <option value="OTR">OTR (Other)</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="tanggal_beli">Tanggal Beli</label>
                        <input type="date" name="tanggal_beli" class="form-control col" id="tanggal_beli" required>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="nomor_urut">Nomor Urut</label>
                        <input type="number" name="nomor_urut" class="form-control col" id="nomor_urut" required>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="diperiksa_oleh">Diperiksa Oleh</label>
                        <input type="text" name="diperiksa_oleh" class="form-control col" id="diperiksa_oleh" required>
                    </div>

                    <div class="form-group row">
                        <label class='col-3' for="tanggal_periksa">Tanggal Periksa</label>
                        <input type="date" name="tanggal_periksa" class="form-control col" id="tanggal_periksa" required>
                    </div>

                    
					<table class="table table-bordered">
						
						<script>
						document.getElementById('jenis').addEventListener('change', function() {
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
                                                <input type="text" name="kelompok" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="merk">Merk</label>
                                                <input type="text" name="merk" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="user">User </label>
                                                <input type="text" name="user" class="form-control col">
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="bagian">Bagian</label>
                                                <input type="text" name="bagian" class="form-control col">
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="tanggalmasuk">Tanggal Masuk</label>
                                                <input type="date" name="tanggalmasuk" class="form-control col" id="tanggal_masuk" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                                                <input type="date" name="tanggalkeluar" class="form-control col">
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="harga">Harga</label>
                                                <input type="number" name="harga" class="form-control col">
                                            </div>  
                                            <div class="form-group row">
                                                <label class='col-3' for="keterangan">Keterangan</label>
                                                <input type="text" name="keterangan" class="form-control col">
                                            </div>
                                        `;
									break;
								case 'CPU':
									additionalFields = `
                                            <div class="form-group row">
                                                <label class='col-3' for="kelompok">kelompok</label>
                                                <input type="text" name="kelompok" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="processor">Processor</label>
                                                <input type="text" name="processor" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="motherboard">MotherBoard</label>
                                                <input type="text" name="motherboard" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="memory">Memory</label>
                                                <input type="text" name="memory" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="harddisk">Harddisk</label>
                                                <input type="text" name="harddisk" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="lancard">Lan Card</label>
                                                <input type="text" name="lancard" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="vgacard">VGA Card</label>
                                                <input type="text" name="vgacard" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="mouse">Mouse</label>
                                                <input type="text" name="mouse" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="keyboard">Keyboard</label>
                                                <input type="text" name="keyboard" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="os">OS</label>
                                                <input type="text" name="os" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="antivirus">Anti Virus</label>
                                                <input type="text" name="antivirus" class="form-control col">
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="office">Office</label>
                                                <input type="text" name="office" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="ip">IP</label>
                                                <input type="text" name="ip" class="form-control col">
                                            </div>
                                            <div class="form-group row" >
                                                <label class='col-3' for="user">User </label>
                                                <input type="text" name="user" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="bagian">Bagian</label>
                                                <input type="text" name="bagian" class="form-control col">
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="expantivirus">Exp. Anti Virus</label>
                                                <input type="date" name="expantivirus" class="form-control col">
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="tanggalmasuk">Tanggal Masuk</label>
                                                <input type="date" name="tanggalmasuk" class="form-control col" id="tanggal_masuk" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                                                <input type="date" name="tanggalkeluar" class="form-control col">
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="harga">Harga</label>
                                                <input type="number" name="harga" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="keterangan">Keterangan</label>
                                                <input type="text" name="keterangan" class="form-control col" required>
                                            </div>
                                            <!-- Additional CPU/NBK fields here -->
                                        `;
									break;
								case 'NBK':
									additionalFields = `
                                            <div class="form-group row">
                                                <label class='col-3' for="kelompok">kelompok</label>
                                                <input type="text" name="kelompok" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="processor">Processor</label>
                                                <input type="text" name="processor" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="merk">Merk</label>
                                                <input type="text" name="merk" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="memory">Memory</label>
                                                <input type="text" name="memory" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="harddisk">Harddisk</label>
                                                <input type="text" name="harddisk" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="dvd_cd_rw">DVD/CD-RW</label>
                                                <input type="text" name="dvd_cd_rw" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="layar">Layar</label>
                                                <input type="text" name="layar" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="wifi">Wifi</label>
                                                <input type="text" name="wifi" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="webcam">Webcam</label>
                                                <input type="text" name="webcam" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="tas">Tas</label>
                                                <input type="text" name="tas" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="os">OS</label>
                                                <input type="text" name="os" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="antivirus">Anti Virus</label>
                                                <input type="text" name="antivirus" class="form-control col">
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="office">Office</label>
                                                <input type="text" name="office" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="ip">IP</label>
                                                <input type="text" name="ip" class="form-control col">
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="user">User </label>
                                                <input type="text" name="user" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="bagian">Bagian</label>
                                                <input type="text" name="bagian" class="form-control col">
                                            </div>
                                           <div class="form-group row">
                                                <label class='col-3' for="tanggalmasuk">Tanggal Masuk</label>
                                                <input type="date" name="tanggalmasuk" class="form-control col" id="tanggal_masuk" required>
                                            </div>
                                            <div class=" form-group row">
                                                <label class='col-3' for="tanggalkeluar">Tanggal Keluar</label>
                                                <input type="date" name="tanggalkeluar" class="form-control col">
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="harga">Harga</label>
                                                <input type="number" name="harga" class="form-control col" required>
                                            </div>
                                            <div class="form-group row">
                                                <label class='col-3' for="keterangan">Keterangan</label>
                                                <input type="text" name="keterangan" class="form-control col    " required>
                                            </div>
                                            <!-- Additional CPU/NBK fields here -->
                                        `;
									break;
							}
							document.getElementById('additional-inputs').innerHTML = additionalFields;
                            document.getElementById('tanggal_beli').addEventListener('change', function() {
                                    const tanggalBeli = this.value;

                                    // Set the same date for Tanggal Periksa and Tanggal Masuk
                                    document.getElementById('tanggal_periksa').value = tanggalBeli;
                                    const tanggalMasukInput = document.querySelector('input[name="tanggalmasuk"]'); // Select the Tanggal Masuk input
                                    if (tanggalMasukInput) {
                                        tanggalMasukInput.value = tanggalBeli; // Set the value for Tanggal Masuk
                                    }
                                });
                        });
						</script>

                       
						<div id="additional-inputs"></div>
					</table>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div> 
@endsection