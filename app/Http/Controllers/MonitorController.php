<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class monitorController extends Controller
{
    public function monitor(Request $request)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('view stock')) {
            return view('inventory.noakses');
        }
        // Retrieve start and end date from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $cabangId = $request->input('cabangid');
        $departemenid = $request->input('departemenid');

        // Initialize query and sort by tanggalmasuk in ascending order
        $query = Monitor::query()->orderBy('tanggalmasuk', 'desc');

        // Check if both start and end dates are provided and filter by date range
        if ($startDate && $endDate) {
            $query->whereBetween('tanggalmasuk', [$startDate, $endDate]);
        }

        if ($cabangId) {
            $query->whereRaw("split_part(stocknumber, '/', 1) = ?", [$cabangId]);
        }

        if ($departemenid) {
            $query->whereRaw("split_part(stocknumber, '/', 2) = ?", [$departemenid]);
        }

        // Execute the query and paginate the results, showing 10 items per page
        $Monitor = $query->paginate(10); // Pagination with 10 records per page

        // Return the filtered and paginated stock list to the view
        return view('inventory.Monitor', compact('Monitor'));
    }

    public function create()
    {
        return view('monitor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'harga' => 'nullable|numeric',
            'user ' => 'nullable|string|max:255',
            'tanggalmasuk' => 'required|date',
            'tanggalkeluar' => 'nullable|date',
            'keterangan' => 'nullable|string|max:500',
            'kelompok' => 'nullable|string|max:500',
            'departemenid' => 'required|string|max:255',
        ]);

        monitor::create($request->all());
        return redirect()->route('inventory.monitor')->with('success', 'monitor created successfully.');
    }

    public function edit(monitor $monitor)
    {
        //ambil data stock berdasarkan stock number dari $monitor
        $stock = Stock::where('stocknumber', $monitor->stocknumber)->first();
        // dd($monitor->stocknumber);
        return view('monitor.edit', compact('monitor', 'stock'));
    }

    public function update(Request $request, monitor $monitor)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'harga' => 'nullable|numeric',
            'user ' => 'nullable|string|max:255',
            'tanggalmasuk' => 'required|date',
            'tanggalkeluar' => 'nullable|date',
            'keterangan' => 'nullable|string|max:500',
            'kelompok' => 'nullable|string|max:255',
            'departemenid' => 'required|string|max:255',
        ]);

        $jenis = $request->input('jenis');
        //update stock number
        $tanggalBeli = date('d/m/y', strtotime($request->tanggal_beli));
        $tanggalBeli = explode('/', $tanggalBeli);
        $tanggalBeli = $tanggalBeli[0] . '/' . $tanggalBeli[1] . '/' . $tanggalBeli[2];
        $newstocknumber = $request->cabang . '/' . $request->departemen . '/' . $request->jenis . '/' . $tanggalBeli . '/' . $request->nomor_urut;

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

        if ($jenis === 'MNT' || $jenis === 'UPS' || $jenis === 'PRN' || $jenis === 'SWP' || $jenis === 'SWH' || $jenis === 'HDE' || $jenis === 'MDM' || $jenis === 'OTR') {
            DB::table($listTable[$jenis])->insert([
                'stocknumber' => $newstocknumber,
                'departemenid' => $request->departemenid,
                'merk' => $request->merk,
                'harga' => $request->harga,
                'user' => $request->user,
                'tanggalmasuk' => $request->tanggalmasuk,
                'tanggalkeluar' => $request->tanggalkeluar,
                'keterangan' => $request->keterangan,
                'kelompok' => $request->kelompok,
                'bagian' => $request->bagian,

            ]);
        } else if ($jenis === 'CPU') {
            DB::table('komputer')->insert([
                'departemenid' => $request->departemenid,
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
                'bagian' => $request->bagian,
                'expantivirus' => $request->expantivirus,
                'tanggalmasuk' => $request->tanggalmasuk,
                'tanggalkeluar' => $request->tanggalkeluar,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
                'stocknumber' => $newstocknumber,
            ]);
        } else if ($jenis === 'NBK') {
            DB::table('notebook')->insert([
                'stocknumber' => $newstocknumber,
                'departemenid' => $request->departemenid,
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
                'bagian' => $request->bagian,
                'tanggalmasuk' => $request->tanggalmasuk,
                'tanggalkeluar' => $request->tanggalkeluar,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
            ]);
        }


        Stock::where('stocknumber', $monitor->stocknumber)->update([
            'stocknumber' => $newstocknumber,
            'cabangid' => $request->cabang,
            'departemenid' => $request->departemen,
            'jenisid' => $request->jenis,
            'tanggalbeli' => $request->tanggal_beli,
            'nomorurut' => $request->nomor_urut,
            'diperiksaoleh' => $request->diperiksa_oleh,
            'tanggalperiksa' => $request->tanggal_periksa,
        ]);

        //hapus monitor
        monitor::where('stocknumber', $monitor->stocknumber)->delete();
        //$monitor->update($request->all());
        return redirect()->route('inventory.monitor')->with('success', 'Monitor updated successfully.');
    }

    public function destroy($stocknumber)
    {
        $stock = Stock::where('stocknumber', str_replace('-', '/', $stocknumber))->firstOrFail();

        $stock->delete();

        return redirect()->back()->with('success', 'Stock deleted successfully.');
    }
}
