@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="header bg-success text-white py-3 text-center">
                <h1>Stock Management</h1>
            </div>
        </div>
    </div>

    <!-- Sidebar and Main Content -->
    <div class="row mt-3">
       <!-- Include Sidebar Component -->
       <x-sidebar />
        <!-- Main Content (right) -->
        <div class="col-md-9">
            <div class="main-content bg-white p-4 rounded">
                <h2 class="mb-4">Printer List</h2>
                <!-- Filter Button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                    Open Filters
                </button>

                <!-- Include the Modal Component -->
                <x-filter-modal :route="request()->url()" />

                <a href="{{ route('inventory.printer') }}" class="btn btn-secondary">
                    Clear Filters
                </a>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Stock Number</th>
                                <th>kelompok</th>
                                <th>Merk</th>
                                <th>User</th>
                                <th>Departemen</th>
                                <th>Bagian</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Harga</th>
                                <th>Keterangan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Printer as $index => $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($Printer->currentPage() - 1) * $Printer->perPage() }}</td>
                                    <td>{{ $item->stocknumber }}</td>
                                    <td>{{ $item->kelompok }}</td>
                                    <td>{{ $item->merk }}</td>
                                    <td>{{ $item->user }}</td>
                                    <td>{{ $item->departemenid }}</td>
                                    <td>{{ $item->bagian }}</td>
                                    <td>{{ $item->tanggalmasuk }}</td>
                                    <td>{{ $item->tanggalkeluar }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <x-action :item="$item" />
                                    </td>                                 
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 <!-- Pagination Links -->
                 <div class="d-flex justify-content-center mt-3">
                    {{ $Printer->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection