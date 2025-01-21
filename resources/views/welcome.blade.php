<form action="{{ route('items.store') }}" method="POST">
    @csrf
    <!-- Inputan Utama -->
    <label for="cabang">Cabang:</label>
    <input type="number" name="cabang" maxlength="3" required><br>

    <label for="departemen">Departemen:</label>
    <select name="departemen" required>
        <option value="SLS">SLS</option>
        <option value="SRV">SRV</option>
        <option value="SPR">SPR</option>
        <option value="KWL">KWL</option>
        <option value="OTR">OTR</option>
    </select><br>

    <label for="jenis">Jenis:</label>
    <select name="jenis" id="jenis" required>
        <option value="MNT">MNT</option>
        <option value="CPU">CPU</option>
        <option value="NBK">NBK</option>
        <option value="HDE">HDE</option>
        <option value="UPS">UPS</option>
        <option value="SWP">SWP</option>
        <option value="SWH">SWH</option>
        <option value="PRN">PRN</option>
        <option value="MDM">MDM</option>
        <option value="OTR">OTR</option>
    </select><br>

    <label for="tanggal_beli">Tanggal Beli:</label>
    <input type="date" name="tanggal_beli" required><br>

    <label for="nomor_urut">Nomor Urut:</label>
    <input type="number" name="nomor_urut" maxlength="3" required><br>

    <label for="diperiksa_oleh">Diperiksa Oleh:</label>
    <input type="text" name="diperiksa_oleh" maxlength="255" required><br>

    <label for="tanggal_periksa">Tanggal Periksa:</label>
    <input type="date" name="tanggal_periksa" required><br>

    <!-- Input Tambahan Berdasarkan Jenis -->
    <div id="additionalFields"></div>

    <button type="submit">Submit</button>
</form>

<script>
    document.getElementById('jenis').addEventListener('change', function() {
        let jenis = this.value;
        let additionalFields = document.getElementById('additionalFields');
        additionalFields.innerHTML = ''; // Bersihkan input tambahan

        if (jenis === 'MNT') {
            additionalFields.innerHTML = `
                <label for="kel">Kel:</label>
                <input type="text" name="kel" required><br>

                <label for="merk">Merk:</label>
                <input type="text" name="merk" required><br>

                <label for="user">User:</label>
                <input type="text" name="user" required><br>

                <label for="tanggalkeluar">Tgl Klr:</label>
                <input type="date" name="tanggalkeluar" required><br>

                <label for="keterangan">Keterangan:</label>
                <input type="text" name="keterangan"><br>
            `;
        } else if (jenis === 'CPU') {
            additionalFields.innerHTML = `
                <label for="kel">Kel:</label>
                <input type="text" name="kel" required><br>

                <label for="processor">processor:</label>
                <input type="text" name="processor" required><br>

                <label for="motherboard">MotherBoard:</label>
                <input type="text" name="motherboard" required><br>

                <label for="memory">Memory:</label>
                <input type="text" name="memory" required><br>

                <label for="harddisk">Harddisk:</label>
                <input type="text" name="harddisk" required><br>

                <label for="lan_card">Lan Card:</label>
                <input type="text" name="lan_card" value="on board" required><br>

                <label for="vga_card">VGA Card:</label>
                <input type="text" name="vga_card" value="on board" required><br>

                <label for="mouse">Mouse:</label>
                <input type="text" name="mouse" value="genius" required><br>

                <label for="keyboard">Keyboard:</label>
                <input type="text" name="keyboard" value="genius" required><br>

                <label for="os">OS:</label>
                <input type="text" name="os" required><br>

                <label for="anti_virus">Anti Virus:</label>
                <input type="text" name="anti_virus" required><br>

                <label for="office">Office:</label>
                <input type="text" name="office" required><br>

                <label for="ip">IP:</label>
                <input type="text" name="ip" required><br>

                <label for="user">User:</label>
                <input type="text" name="user" required><br>

                <label for="bagian">Bagian:</label>
                <input type="text" name="bagian" required><br>

                <label for="exp_anti_virus">Exp. Anti Virus:</label>
                <input type="date" name="exp_anti_virus" required><br>

                <label for="tanggalmasuk">Tgl Msk:</label>
                <input type="date" name="tanggalmasuk" required><br>

                <label for="tanggalkeluar">Tgl Klr:</label>
                <input type="date" name="tanggalkeluar" required><br>

                <label for="harga">Harga:</label>
                <input type="number" name="harga" required><br>

                <label for="keterangan">Keterangan:</label>
                <input type="text" name="keterangan" value="prima" required><br>
            `;
        }
    });
</script>
