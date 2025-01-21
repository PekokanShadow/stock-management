<!-- resources/views/qrcode.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .qr-container {
            display: inline-block;
            padding: 20px;
            border: 1px solid #ddd;
            margin-top: 20px;
        }
        .stock-number {
            font-size: 17px; /* Adjust size of the stock number text */
            margin-top: 10px;
        }
        .print-button {
            margin-top: 20px; 
            display: inline-block; 
            padding: 10px 15px; 
            background-color: #007bff; 
            color: white; 
            text-decoration: none; 
            border-radius: 5px;
        }
        /* Hide the print button when printing */
        @media print {
            .print-button {
                display: none; /* Hide the button during printing */
            }
        }
    </style>
</head>
<body>
    <div class="qr-container">
        <div>{!! $qrcode !!}</div>
        <div class="stock-number">{{ $stocknumber }}</div> <!-- Display the stock number beneath QR code -->
    </div>
    <a href="javascript:window.print()" class="print-button">Print QR Code</a>
</body>
</html>