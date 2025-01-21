@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="header bg-success text-white py-3 text-center">
                <h1>Stock Details</h1>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="main-content bg-white p-4 rounded">
                <h2 class="mb-4">Details of Stock Number: {{ $stock->stocknumber }}</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Cabang</th>
                        <td>{{ $stock->cabangid }}</td>
                    </tr>
                    <tr>
                        <th>Departemen</th>
                        <td>{{ $stock->departemenid }}</td>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <td>{{ $stock->jenisid }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Beli</th>
                        <td>{{ $stock->tanggalbeli }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Urut</th>
                        <td>{{ $stock->nomorurut }}</td>
                    </tr>
                    <tr>
                        <th>Diperiksa Oleh</th>
                        <td>{{ $stock->diperiksaoleh }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Periksa</th>
                        <td>{{ $stock->tanggalperiksa }}</td>
                    </tr>

                    <!-- Additional Details -->
                    @if($additionalDetails)
                        @foreach($additionalDetails->getAttributes() as $key => $value)
                            <tr>
                                <th>{{ ucfirst($key) }}</th>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
                <a href="{{ url()->previous()  }}" class="btn btn-secondary">Back<-----</a>
            </div>
        </div>
    </div>
</div>
@endsection