<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Ups; // Import the UPS model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UPSController extends Controller
{
    public function Ups(Request $request)
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
        $query = Ups::query()->orderBy('tanggalmasuk', 'desc');

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
        $Ups = $query->paginate(10); // Pagination with 10 records per page

        // Return the filtered and paginated stock list to the view
        return view('inventory.Ups', compact('Ups'));
    }

    public function create()
    {
        return view('ups.create');
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
        ]);

        UPS::create($request->all());
        return redirect()->route('inventory.ups')->with('success', 'UPS created successfully.');
    }

    public function edit(UPS $ups)
    {
        return view('ups.edit', compact('ups'));
    }

    public function update(Request $request, UPS $ups)
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
        ]);

        $ups->update($request->all());
        return redirect()->route('inventory.ups')->with('success', 'UPS updated successfully.');
    }

    public function destroy($stocknumber)
    {
        $stock = Stock::where('stocknumber', str_replace('-', '/', $stocknumber))->firstOrFail();

        $stock->delete();

        return redirect()->back()->with('success', 'Stock deleted successfully.');
    }
}
