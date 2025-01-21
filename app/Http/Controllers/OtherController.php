<?php

namespace App\Http\Controllers;

use App\Models\Other; // Import the other model
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class otherController extends Controller
{
    public function other(Request $request)
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
        $query = Other::query()->orderBy('tanggalmasuk', 'desc');

        // Check if both start and end dates are provided and filter by date range
        if ($startDate && $endDate) {
            $query->whereBetween('tanggalmasuk', [$startDate, $endDate]);
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
        $other = $query->paginate(10); // Pagination with 10 records per page

        // Return the filtered and paginated stock list to the view
        return view('inventory.Other', compact('other'));
    }

    public function create()
    {
        return view('other.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'harga' => 'nullable|numeric',
            'user ' => 'nullable|string|max:255',
            'bagian' => 'required|string|max:255',
            'tanggalmasuk' => 'required|date',
            'tanggalkeluar' => 'nullable|date|after_or_equal:tanggalmasuk',
            'keterangan' => 'nullable|string|max:500',
            'kelompok' => 'nullable|string|max:500',
            'departemenid' => 'required|string|max:255',
            'jenisid' => 'required|string|max:255',
        ]);

        other::create($request->all());
        return redirect()->route('inventory.Other')->with('success', 'other created successfully.');
    }

    public function edit(other $other)
    {
        return view('other.edit', compact('other'));
    }

    public function update(Request $request, other $other)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'harga' => 'nullable|numeric',
            'user ' => 'nullable|string|max:255',
            'bagian' => 'required|string|max:255',
            'tanggalmasuk' => 'required|date',
            'tanggalkeluar' => 'nullable|date|after_or_equal:tanggalmasuk',
            'keterangan' => 'nullable|string|max:500',
            'kelompok' => 'nullable|string|max:255',
            'departemenid' => 'required|string|max:255',
            'jenisid' => 'required|string|max:255',
        ]);

        $other->update($request->all());
        return redirect()->route('inventoryOther')->with('success', 'other updated successfully.');
    }

    public function destroy($stocknumber)
    {
        $stock = Stock::where('stocknumber', str_replace('-', '/', $stocknumber))->firstOrFail();

        $stock->delete();

        return redirect()->back()->with('success', 'Stock deleted successfully.');
    }
}
