<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarcodeController extends Controller
{
    public function generateBarcode($stocknumber)
    {
        $userLogin = Auth::user();
        if (!$userLogin->can('print qrcode')) {
            return view('inventory.noakses');
        }
        // Generate the URL for the stock details page
        // Ensure the stock number is formatted with dashes
        $url = route('inventory.details', ['stocknumber' => str_replace('/', '-', $stocknumber)]);

        // Generate the QR code with the URL
        $qrcode = QrCode::size(200)->generate($url);

        return view('qrcode', compact('qrcode', 'stocknumber'));
    }
}
