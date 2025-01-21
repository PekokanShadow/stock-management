<?php

namespace App\Http\Controllers;

use App\Models\Printer; // Import the printer model
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class printerController extends Controller
{
    public function printer(Request $request)
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
        $query = Printer::query()->orderBy('tanggalmasuk', 'desc');

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
        $Printer = $query->paginate(10); // Pagination with 10 records per page

        // Return the filtered and paginated stock list to the view
        return view('inventory.Printer', compact('Printer'));
    }

    public function create()
    {
        return view('printer.create');
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

        printer::create($request->all());
        return redirect()->route('inventory.printer')->with('success', 'printer created successfully.');
    }

    public function edit(printer $printer)
    {
        return view('printer.edit', compact('printer'));
    }

    public function update(Request $request, printer $printer)
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

        $printer->update($request->all());
        return redirect()->route('inventory.printer')->with('success', 'printer updated successfully.');
    }

    public function destroy($stocknumber)
    {
        $stock = Stock::where('stocknumber', str_replace('-', '/', $stocknumber))->firstOrFail();

        $stock->delete();

        return redirect()->back()->with('success', 'Stock deleted successfully.');
    }
}
