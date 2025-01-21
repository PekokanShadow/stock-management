<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    // Display stock list with optional date filtering
    public function Stock(Request $request)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('view stock')) {
            return view('inventory.noakses');
        }
        // Retrieve start and end date from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $cabangId = $request->input('cabangid');
        $jenis = $request->input('jenisid');
        $departemenid = $request->input('departemenid');

        // Initialize query and sort by tanggalmasuk in ascending order
        $query = Stock::query()->orderBy('tanggalbeli', 'desc');

        // Check if both start and end dates are provided and filter by date range
        if ($startDate && $endDate) {
            $query->whereBetween('tanggalbeli', [$startDate, $endDate]);
        }
        if ($cabangId) {
            $query->whereRaw("split_part(stocknumber, '/', 1) = ?", [$cabangId]);
        }
        if ($jenis) {
            $query->where('jenisid', $jenis);
        }
        if ($departemenid) {
            $query->whereRaw("split_part(stocknumber, '/', 2) = ?", [$departemenid]);
        }

        // Execute the query and paginate the results, showing 10 items per page
        $Stock = $query->paginate(10); // Pagination with 10 records per page

        // Return the filtered and paginated stock list to the view
        return view('inventory.Rekap', compact('Stock'));
    }

    // Show create stock form
    public function create()
    {
        return view('stock.create');
    }

    // Store new stock record
    public function store(Request $request)
    {
        $request->validate([
            'cabangid' => 'required|string|max:255',
            'departemenid' => 'required|string|max:255',
            'jenisid' => 'required|string|max:255',
            'tanggalbeli' => 'required|date',
            'nomourut' => 'required|string|max:255',
            'diperiksaoleh' => 'required|string|max:255',
            'tanggalperiksa' => 'required|date',
            'stocknumber' => 'required|string|unique:stock,stocknumber|max:255',
        ]);

        Stock::create($request->all());
        return redirect()->route('inventory.rekap')->with('success', 'Stock created successfully.');
    }

    // Show edit form for specific stock record
    public function edit(Stock $stock)
    {
        return view('stock.edit', compact('stock'));
    }

    // Update stock record
    public function update(Request $request, Stock $stock)
    {
        $request->validate([
            'cabangid' => 'required|string|max:255',
            'departemenid' => 'required|string|max:255',
            'jenisid' => 'required|string|max:255',
            'tanggalbeli' => 'required|date',
            'nomourut' => 'required|string|max:255',
            'diperiksaoleh' => 'required|string|max:255',
            'tanggalperiksa' => 'required|date',
            'stocknumber' => 'required|string|unique:stock,stocknumber,' . $stock->id . '|max:255',
        ]);

        $stock->update($request->all());
        return redirect()->route('inventory.rekap')->with('success', 'Stock updated successfully.');
    }

    // Delete stock record
    public function destroy(string $stocknumber)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('delete stock')) {
            return view('inventory.noakses');
        }
        $stocknumber = str_replace('-', '/', $stocknumber);
        $arraystocknumber = explode('/', $stocknumber);
        $jenis = $arraystocknumber[2];

        // Delete record from the stock table
        Stock::where('stocknumber', $stocknumber)->delete();

        // Delete record from the specific type table
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

        DB::table($listTable[$jenis])->where('stocknumber', $stocknumber)->delete();
        return redirect()->route('inventory.rekap')->with('success', 'Stock deleted successfully.');
    }
}
