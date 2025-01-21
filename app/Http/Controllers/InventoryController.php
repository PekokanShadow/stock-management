<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Monitor;
use App\Models\Komputer;
use App\Models\Notebook;
use App\Models\Ups;
use App\Models\Printer;
use App\Models\Hub;
use App\Models\Other; // Import the Other model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function show($stocknumber)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('view details stock')) {
            return view('inventory.noakses');
        }
        // Replace '-' with '/' to get the actual stock number
        $stocknumber = str_replace('-', '/', $stocknumber);

        // Fetch stock details
        $stock = Stock::where('stocknumber', $stocknumber)->first();

        // Fetch additional details based on jenis
        $additionalDetails = null;
        switch ($stock->jenisid) {
            case 'CPU':
                $additionalDetails = Komputer::where('stocknumber', $stocknumber)->first();
                break;
            case 'NBK':
                $additionalDetails = Notebook::where('stocknumber', $stocknumber)->first();
                break;
            case 'MNT':
                $additionalDetails = Monitor::where('stocknumber', $stocknumber)->first();
                break;
            case 'UPS':
                $additionalDetails = Ups::where('stocknumber', $stocknumber)->first();
                break;
            case 'PRN':
                $additionalDetails = Printer::where('stocknumber', $stocknumber)->first();
                break;
            case 'HUB':
                $additionalDetails = Hub::where('stocknumber', $stocknumber)->first();
                break;
            case 'OTR':
                $additionalDetails = Other::where('stocknumber', $stocknumber)->first();
                break;
                // Add cases for SWH, SWP, and MDM
            case 'SWH':
            case 'SWP':
                $additionalDetails = Hub::where('stocknumber', $stocknumber)->first(); // Adjust if needed to fetch from a different table
                break;
            case 'MDM':
            case 'HDE':
                $additionalDetails = Other::where('stocknumber', $stocknumber)->first();
        }

        return view('inventory.Details', compact('stock', 'additionalDetails'));
    }
    // Fetch all komputer data
    public function edit(string $stocknumber)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('edit stock')) {
            return view('inventory.noakses');
        }
        $stocknumber = str_replace('-', '/', $stocknumber);
        $stock = Stock::where('stocknumber', $stocknumber)->first();
        $jenis = $stock->jenisid;
        $listTable = [
            'MNT' => 'monitor',
            'CPU' => 'komputer',
            'NBK' => 'notebook',
            'HDE' => 'other',
            'UPS' => 'ups',
            'SWP' => 'hub',
            'SWH' => 'hub',
            'PRN' => 'printer',
            'MDM' => 'other',
            'OTR' => 'other',
        ];
        $data = DB::table($listTable[$jenis])->where('stocknumber', $stocknumber)->first();

        return view('inventory.Edit', compact('data', 'stock'));
    }
    public function update(Request $request, Stock $stock, string $stocknumber)
    {
        //cek apakah ada nomor urut yang sama di tanggal yang sama
        $cek = Stock::where('nomorurut', '=', $request->input('nomor_urut'))
            ->where('tanggalbeli', '=', $request->input('tanggal_beli'))
            ->where('jenisid', '=', $request->input('jenis'))
            ->where('departemenid', '=', $request->input('departemen'))
            ->where('cabangid', '=', $request->input('cabang'))
            ->exists();
        if ($cek) {
            return back()->withErrors(['nomorurut' => 'Nomor Urut sudah ada di tanggal yang sama']);
        }

        $stocknumber = str_replace('-', '/', $stocknumber);
        $tanggalBeli = date('d/m/y', strtotime($request->tanggal_beli));
        $tanggalBeli = explode('/', $tanggalBeli);
        $tanggalBeli = $tanggalBeli[0] . '/' . $tanggalBeli[1] . '/' . $tanggalBeli[2];
        $newstocknumber = $request->cabang . '/' . $request->departemen . '/' . $request->jenis . '/' . $tanggalBeli . '/' . $request->nomor_urut;

        $arraystocknumber = explode('/', $stocknumber);
        $jenislama = $arraystocknumber[2];

        $jenisbaru = $request->input('jenis');
        $listTable = [
            'MNT' => 'monitor',
            'CPU' => 'komputer',
            'NBK' => 'notebook',
            'HDE' => 'other',
            'UPS' => 'ups',
            'SWP' => 'hub',
            'SWH' => 'hub',
            'PRN' => 'printer',
            'MDM' => 'other',
            'OTR' => 'other',
        ];

        //update data inventory di table stock
        Stock::where('stocknumber', $stocknumber)->update([
            'jenisid' => $request->input('jenis'),
            'stocknumber' => $newstocknumber,
            'diperiksaoleh' => $request->input('diperiksa_oleh'),
            'tanggalbeli' => $request->input('tanggal_beli'),
            'tanggalperiksa' => $request->input('tanggal_periksa'),
            'nomorurut' => $request->input('nomor_urut'),
            'cabangid' => $request->input('cabang'),
            'departemenid' => $request->input('departemen'),
        ]);
        //update data inventory di table sesuai jenis
        if ($jenisbaru == 'MNT' || $jenisbaru == 'HDE' || $jenisbaru == 'UPS' || $jenisbaru == 'SWP' || $jenisbaru == 'SWH' || $jenisbaru == 'PRN' || $jenisbaru == 'MDM' || $jenisbaru == 'OTR') {
            DB::table($listTable[$jenisbaru])->insert([
                'stocknumber' => $newstocknumber,
                'departemenid' => $request->input('departemen'),
                'kelompok' => $request->input('kelompok'),
                'merk' => $request->input('merk'),
                'user' => $request->input('user'),
                'bagian' => $request->input('bagian'),
                'tanggalmasuk' => $request->input('tanggalmasuk'),
                'tanggalkeluar' => $request->input('tanggalkeluar'),
                'harga' => $request->input('harga'),
                'keterangan' => $request->input('keterangan'),
            ]);
        } else if ($jenisbaru == 'CPU') {
            DB::table('komputer')->insert([
                'stocknumber' => $newstocknumber,
                'departemenid' => $request->input('departemen'),
                'kelompok' => $request->input('kelompok'),
                'processor' => $request->input('processor'),
                'motherboard' => $request->input('motherboard'),
                'memory' => $request->input('memory'),
                'harddisk' => $request->input('harddisk'),
                'lancard' => $request->input('lancard'),
                'vgacard' => $request->input('vgacard'),
                'mouse' => $request->input('mouse'),
                'keyboard' => $request->input('keyboard'),
                'os' => $request->input('os'),
                'antivirus' => $request->input('antivirus'),
                'office' => $request->input('office'),
                'ip' => $request->input('ip'),
                'user' => $request->input('user'),
                'expantivirus' => $request->input('expantivirus'),
                'tanggalmasuk' => $request->input('tanggalmasuk'),
                'tanggalkeluar' => $request->input('tanggalkeluar'),
                'harga' => $request->input('harga'),
                'keterangan' => $request->input('keterangan'),
                'bagian' => $request->input('bagian'),

            ]);
        } else if ($jenisbaru == 'NBK') {
            DB::table('notebook')->insert([
                'stocknumber' => $newstocknumber,
                'departemenid' => $request->input('departemen'),
                'kelompok' => $request->input('kelompok'),
                'processor' => $request->input('processor'),
                'merk' => $request->input('merk'),
                'memory' => $request->input('memory'),
                'harddisk' => $request->input('harddisk'),
                'dvd_cd_rw' => $request->input('dvd_cd_rw'),
                'layar' => $request->input('layar'),
                'wifi' => $request->input('wifi'),
                'webcam' => $request->input('webcam'),
                'tas' => $request->input('tas'),
                'os' => $request->input('os'),
                'antivirus' => $request->input('antivirus'),
                'office' => $request->input('office'),
                'ip' => $request->input('ip'),
                'user' => $request->input('user'),
                'tanggalmasuk' => $request->input('tanggalmasuk'),
                'tanggalkeluar' => $request->input('tanggalkeluar'),
                'harga' => $request->input('harga'),
                'keterangan' => $request->input('keterangan'),
                'bagian' => $request->input('bagian'),
            ]);
        }


        //hapus  data inventory di table lama sesuai jenis
        DB::table($listTable[$jenislama])->where('stocknumber', $stocknumber)->delete();
        return redirect()->route('inventory.create')->with('success', 'Data Updated Successfully');
    }
    public function komputer()
    {
        $komputer = Komputer::all();
        return view('inventory.komputer', compact('komputer'));
    }

    // Fetch all notebook data
    public function notebook()
    {
        $notebooks = Notebook::all();
        return view('inventory.notebook', compact('notebooks'));
    }

    // Fetch all monitor data
    public function monitor()
    {
        $monitor = Monitor::all();
        return view('inventory.monitor', compact('monitors'));
    }

    // Fetch all ups data
    public function ups()
    {
        $ups = Ups::all();
        return view('inventory.ups', compact('ups'));
    }

    // Fetch all hub data
    public function Hub()
    {
        $hub = Hub::all();
        return view('inventory.hub', compact('hub'));
    }

    // Fetch all other data
    public function other()
    {
        $other = Other::all(); // Fetch all Other items
        return view('inventory.other', compact('other'));
    }

    // Fetch all rekap data
    public function stock()
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('view stock')) {
            return view('inventory.noakses');
        }
        $stock = Stock::all(); // Implement your logic to fetch rekap data
        return view('inventory.rekap'); // Ensure this view exists
    }

    public function rekap(Request $request)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('view stock')) {
            return view('inventory.noakses');
        }
        $query = Stock::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tanggalbeli', [$request->start_date, $request->end_date]);
        }

        $stock = $query->get();

        return view('inventory.rekap', compact('stock'));
    }


    // Fetch all printer data
    public function printer()
    {
        $printer = Printer::all();
        return view('inventory.printer', compact('printer'));
    }

    // Show the form for creating a new inventory item
    public function create()
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('create stock')) {
            return view('inventory.noakses');
        }
        return view('inventory.create');
    }

    // public function show($stocknumber)
    // {
    //     $komputer = Komputer::findOrFail($stocknumber); // Assuming you have a Komputer model
    //     return view('inventory.details', compact('komputer'));
    // }
    // Store a new inventory item
    public function store(Request $request)
    {
        //cek apakah ada nomor urut yang sama di tanggal yang sama
        $cek = Stock::where('nomorurut', '=', $request->input('nomor_urut'))
            ->where('tanggalbeli', '=', $request->input('tanggal_beli'))
            ->where('jenisid', '=', $request->input('jenis'))
            ->where('departemenid', '=', $request->input('departemen'))
            ->where('cabangid', '=', $request->input('cabang'))
            ->first();
        if ($cek) {
            return back()->withErrors(['nomorurut' => 'Nomor Urut sudah ada di tanggal yang sama']);
        }
        $request->validate([
            'cabang' => 'required|max:3',
            'departemen' => 'required',
            'jenis' => 'required',
            'tanggal_beli' => 'required',
            'nomor_urut' => 'required|max:3',
            'diperiksa_oleh' => 'required',
            'tanggal_periksa' => 'required',
        ], [
            'cabang.required' => 'Cabang harus diisi',
            'cabang.max' => 'Cabang harus 3 karakter',
            'departemen.required' => 'Departemen harus diisi',
            'jenis.required' => 'Jenis harus diisi',
            'tanggal_beli.required' => 'Tanggal Beli harus diisi',
            'nomorurut.required' => 'Nomor Urut harus diisi',
            'nomorurut.max' => 'Nomor Urut harus 3 karakter',
            'diperiksa_oleh.required' => 'Diperiksa Oleh harus diisi',
            'tanggal_periksa.required' => 'Tanggal Periksa harus diisi',
        ]);


        $cabang = $request->input('cabang');
        $departemen = $request->input('departemen');
        $jenis = $request->input('jenis');
        $tanggalBeli = $request->input('tanggal_beli');
        $nomorUrut = $request->input('nomor_urut');
        $diperiksaOleh = $request->input('diperiksa_oleh');
        $tanggalPeriksa = $request->input('tanggal_periksa');

        $tanggalBeli = date('d/m/y', strtotime($tanggalBeli));
        $tanggalBeli = explode('/', $tanggalBeli);
        $tanggalBeli = $tanggalBeli[0] . '/' . $tanggalBeli[1] . '/' . $tanggalBeli[2];

        $stocknumber = $cabang . '/' . $departemen . '/' . $jenis . '/' . $tanggalBeli . '/' . $nomorUrut;


        // Save data to stock table
        Stock::create([
            'cabangid' => $cabang,
            'departemenid' => $departemen,
            'jenisid' => $jenis,
            'tanggalbeli' => $request->input('tanggal_beli'),
            'nomorurut' => $nomorUrut,
            'diperiksaoleh' => $diperiksaOleh,
            'tanggalperiksa' => $tanggalPeriksa,
            'stocknumber' => $stocknumber,
        ]);

        $listTable = [
            'MNT' => 'monitor',
            'CPU' => 'komputer',
            'NBK' => 'notebook',
            'HDE' => 'other',
            'UPS' => 'ups',
            'SWP' => 'hub',
            'SWH' => 'hub',
            'PRN' => 'printer',
            'MDM' => 'other',
            'OTR' => 'other',
        ];

        // simpan ke tabel berdasarkan jenis
        if ($jenis == 'MNT' || $jenis == 'UPS' || $jenis == 'PRN') {

            $request->validate([
                'kelompok' => 'required',
                'merk' => 'required',
                'tanggalmasuk' => 'required',
            ], [
                'kelompok.required' => 'kelompok harus diisi',
                'merk.required' => 'Merk harus diisi',
                'tanggalmasuk.required' => 'Tanggal Masuk harus diisi',
            ]);
            DB::table($listTable[$jenis])->insert([
                'departemenid' => $departemen,
                'kelompok' => $request->kelompok,
                'merk' => $request->merk,
                'user' => $request->user,
                'tanggalmasuk' => $request->tanggalmasuk,
                'tanggalkeluar' => $request->tanggalkeluar,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
                'bagian' => $request->bagian,
                'stocknumber' => $stocknumber,
            ]);
        } else if ($jenis == 'SWP' || $jenis == 'SWH' || $jenis == 'HDE' || $jenis == 'MDM' || $jenis == 'OTR') {

            $request->validate([
                'kelompok' => 'required',
                'merk' => 'required',
                'tanggalmasuk' => 'required',
            ], [
                'kelompok.required' => 'kelompok harus diisi',
                'merk.required' => 'Merk harus diisi',
                'tanggalmasuk.required' => 'Tanggal Masuk harus diisi',
            ]);
            DB::table($listTable[$jenis])->insert([
                'departemenid' => $departemen,
                'kelompok' => $request->kelompok,
                'merk' => $request->merk,
                'user' => $request->user,
                'tanggalmasuk' => $request->tanggalmasuk,
                'tanggalkeluar' => $request->tanggalkeluar,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
                'bagian' => $request->bagian,
                'stocknumber' => $stocknumber,
                'jenisid' => $jenis,
            ]);
        } else if ($jenis == 'CPU') {
            $request->validate([
                'kelompok' => 'required',
                'processor' => 'required',
                'motherboard' => 'required',
                'memory' => 'required',
                'os' => 'required',
                'office' => 'required',
                'tanggalmasuk' => 'required',
            ], [
                'kelompok.required' => 'kelompok harus diisi',
                'processor.required' => 'processor harus diisi',
                'motherboard.required' => 'Motherboard harus diisi',
                'memory.required' => 'Memory harus diisi',
                'os.required' => 'Os harus diisi',
                'office.required' => 'Office harus diisi',
                'tanggalmasuk.required' => 'Tanggal Masuk harus diisi',
            ]);
            DB::table($listTable[$jenis])->insert([
                'departemenid' => $departemen,
                'kelompok' => $request->kelompok,
                'processor' => $request->processor,
                'motherboard' => $request->motherboard,
                'memory' => $request->memory,
                'harddisk' => $request->harddisk,
                'lancard' => $request->lancard,
                'vgacard' => $request->vgacard,
                'mouse' => $request->mouse,
                'keyboard' => $request->keyboard,
                'os' => $request->os,
                'antivirus' => $request->antivirus,
                'office' => $request->office,
                'ip' => $request->ip,
                'user' => $request->user,
                'expantivirus' => $request->expantivirus,
                'tanggalmasuk' => $request->tanggalmasuk,
                'tanggalkeluar' => $request->tanggalkeluar,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
                'bagian' => $request->bagian,
                'stocknumber' => $stocknumber,
            ]);
        } else if ($jenis == 'NBK') {
            $request->validate([
                'kelompok' => 'required',
                'processor' => 'required',
                'merk' => 'required',
                'memory' => 'required',
                'layar' => 'required',
                'office' => 'required',
                'tanggalmasuk' => 'required',
            ], [
                'kelompok.required' => 'kelompok harus diisi',
                'processor.required' => 'processor harus diisi',
                'merk.required' => 'Merk harus diisi',
                'memory.required' => 'Memory harus diisi',
                'layar.required' => 'Layar harus diisi',
                'office.required' => 'Office harus diisi',
                'tanggalmasuk.required' => 'Tanggal Masuk harus diisi',
            ]);
            DB::table($listTable[$jenis])->insert([
                'departemenid' => $departemen,
                'kelompok' => $request->kelompok,
                'processor' => $request->processor,
                'merk' => $request->merk,
                'memory' => $request->memory,
                'harddisk' => $request->harddisk,
                'dvd_cd_rw' => $request->dvd_cd_rw,
                'layar' => $request->layar,
                'wifi' => $request->wifi,
                'webcam' => $request->webcam,
                'tas' => $request->tas,
                'os' => $request->os,
                'antivirus' => $request->antivirus,
                'office' => $request->office,
                'ip' => $request->ip,
                'user' => $request->user,
                'tanggalmasuk' => $request->tanggalmasuk,
                'tanggalkeluar' => $request->tanggalkeluar,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
                'bagian' => $request->bagian,
                'stocknumber' => $stocknumber,
            ]);
        };

        return redirect('/inventory/create')->with('success', 'Data berhasil ditambahkan');
    }
}
