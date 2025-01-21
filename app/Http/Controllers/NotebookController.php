<?php

namespace App\Http\Controllers;

use App\Models\Notebook; // Make sure to import the Notebook model
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotebookController extends Controller
{
    public function Notebook(Request $request)
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
        $query = Notebook::query()->orderBy('tanggalmasuk', 'desc');

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
        $Notebook = $query->paginate(10); // Pagination with 10 records per page

        // Return the filtered and paginated stock list to the view
        return view('inventory.Notebook', compact('Notebook'));
    }


    public function create()
    {
        return view('notebook.create'); // Return the create view
    }

    public function store(Request $request)
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'processor' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'memory' => 'required|string|max:255',
            'harddisk' => 'required|string|max:255',
            'dvd_cd_rw' => 'nullable|string|max:255',
            'layar' => 'required|string|max:255',
            'wifi' => 'required|string|max:255',
            'webcam' => 'nullable|string|max:255',
            'tas' => 'nullable|string|max:255',
            'os' => 'required|string|max:255',
            'antivirus' => 'nullable|string|max:255',
            'office' => 'nullable|string|max:255',
            'ip' => 'nullable|string|max:255',
            'user  ' => 'required|string|max:255',
            'bagian' => 'required|string|max:255',
            'tanggalmasuk' => 'required|date',
            'tanggalkeluar' => 'required|date|after_or_equal:tanggalmasuk',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string|max:500',
            'departemenid' => 'required|string|max:255',
            'kelompok.*' => 'string|max:255', // Validate each item in the kelompok array
        ]);

        Notebook::create($request->all()); // Store the notebook data
        return redirect()->route('inventory.notebook')->with('success', 'Notebook created successfully.');
    }

    public function edit(Notebook $Notebook)
    {
        return view('notebook.edit', compact('notebook')); // Return the edit view
    }

    public function update(Request $request, Notebook $notebook)
    {
        $request->validate([
            'processor' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'memory' => 'required|string|max:255',
            'harddisk' => 'required|string|max:255',
            'dvd_cd_rw' => 'nullable|string|max:255',
            'layar' => 'required|string|max:255',
            'wifi' => 'nullable|string|max:255',
            'webcam' => 'nullable|string|max:255',
            'tas' => 'nullable|string|max:255',
            'os' => 'required|string|max:255',
            'antivirus' => 'nullable|string|max:255',
            'office' => 'nullable|string|max:255',
            'ip' => 'nullable|string|max:255',
            'user  ' => 'nullable|string|max:255',
            'bagian' => 'required|string|max:255',
            'tanggalmasuk' => 'required|date',
            'tanggalkeluar' => 'nullable|date|after_or_equal:tanggalmasuk',
            'harga' => 'nullable|numeric',
            'keterangan' => 'nullable|string|max:500',
            'kelompok' => 'nullable|string|max:500',
            'departemenid' => 'required|string|max:255',
        ]);
        return redirect()->route('inventory.notebook')->with('success', 'Notebook updated successfully.');
    }

    public function destroy($stocknumber)
    {
        $stock = Stock::where('stocknumber', str_replace('-', '/', $stocknumber))->firstOrFail();

        $stock->delete();

        return redirect()->back()->with('success', 'Stock deleted successfully.');
    }
}
