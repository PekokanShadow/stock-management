<?php

namespace App\Http\Controllers;

use App\Models\Komputer;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomputerController extends Controller
{
    public function Komputer(Request $request)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('view stock')) {
            return view('inventory.noakses');
        }
        // Retrieve start date, end date, and cabangid from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $cabangId = $request->input('cabangid');
        $departemenid = $request->input('departemenid');

        // Initialize query and sort by tanggalmasuk in descending order
        $query = Komputer::query()->orderBy('tanggalmasuk', 'desc');

        // Filter by date range if both start and end dates are provided
        if ($startDate && $endDate) {
            $query->whereBetween('tanggalmasuk', [$startDate, $endDate]);
        }

        // Filter by cabangid if provided using PostgreSQL's split_part function
        if ($cabangId) {
            $query->whereRaw("split_part(stocknumber, '/', 1) = ?", [$cabangId]);
        }

        if ($departemenid) {
            $query->whereRaw("split_part(stocknumber, '/', 2) = ?", [$departemenid]);
        }

        // Paginate the results
        $Komputer = $query->paginate(10);

        // Return the filtered and paginated list to the view
        return view('inventory.Komputer', compact('Komputer'));
    }



    public function create()
    {
        return view('komputer.create'); // Ensure the view path is correct
    }

    public function store(Request $request)
    {
        $request->validate([
            'processor' => 'required|string|max:255',
            'motherboard' => 'required|string|max:255',
            'memory' => 'required|string|max:255',
            'harddisk' => 'required|string|max:255',
            'lancard' => 'nullable|string|max:255',
            'vgacard' => 'nullable|string|max:255',
            'mouse' => 'nullable|string|max:255',
            'keyboard' => 'nullable|string|max:255',
            'os' => 'required|string|max:255',
            'antivirus' => 'nullable|string|max:255',
            'office' => 'nullable|string|max:255',
            'ip' => 'nullable|string|max:255',
            'user   ' => 'required|string|max:255',
            'bagian' => 'required|string|max:255',
            'expantivirus' => 'nullable|date',
            'tanggalmasuk' => 'required|date',
            'tanggalkeluar' => 'required|date|after_or_equal:tanggalmasuk',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string|max:500',
            'kelompok' => 'nullable|string|max:255',
            'departemenid' => 'required|string|max:255',
        ]);

        Komputer::create($request->all());
        return redirect()->route('inventory.komputer')->with('success', 'Komputer created successfully.'); // Use the correct route name
    }

    public function edit(Komputer $komputer)
    {
        return view('komputer.edit', compact('komputer')); // Ensure the view path is correct
    }

    public function update(Request $request, Komputer $komputer)

    {
        $request->validate([
            'processor' => 'required|string|max:255',
            'motherboard' => 'required|string|max:255',
            'memory' => 'required|string|max:255',
            'harddisk' => 'required|string|max:255',
            'lancard' => 'nullable|string|max:255',
            'vgacard' => 'nullable|string|max:255',
            'mouse' => 'nullable|string|max:255',
            'keyboard' => 'nullable|string|max:255',
            'os' => 'required|string|max:255',
            'antivirus' => 'nullable|string|max:255',
            'office' => 'nullable|string|max:255',
            'ip' => 'nullable|string|max:255',
            'user   ' => 'nullable|string|max:255',
            'bagian' => 'required|string|max:255',
            'expantivirus' => 'nullable|date',
            'tanggalmasuk' => 'required|date',
            'tanggalkeluar' => 'nullable|date|after_or_equal:tanggalmasuk',
            'harga' => 'nullable|numeric',
            'keterangan' => 'nullable|string|max:500',
            'kelompok' => 'nullable|string|max:255',
            'departemenid' => 'required|string|max:255',
        ]);

        $komputer->update($request->all());
        return redirect()->route('inventory.komputer')->with('success', 'Komputer updated successfully.'); // Use the correct route name
    }

    public function destroy($stocknumber)
    {
        $stock = Stock::where('stocknumber', str_replace('-', '/', $stocknumber))->firstOrFail();

        $stock->delete();

        return redirect()->back()->with('success', 'Stock deleted successfully.');
    }
}
