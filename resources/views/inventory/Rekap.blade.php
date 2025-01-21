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
                <h2 class="mb-4">Stock List</h2>

                <!-- Filter Button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                    Open Filters
                </button>
                
                <!-- Include the Modal Component -->
                <x-filter2-modal :route="request()->url()" />
                
                <a href="{{ route('inventory.rekap') }}" class="btn btn-secondary">
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
                                <th>Cabang</th>
                                <th>Departemen</th>
                                <th>Jenis</th>
                                <th>Tanggal Beli</th>
                                <th>Nomor Urut</th>
                                <th>Diperiksa Oleh</th>
                                <th>Tanggal Periksa</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Stock as $index => $item)
                                <tr>
                                    <!-- Calculate index based on pagination -->
                                    <td>{{ $loop->iteration + ($Stock->currentPage() - 1) * $Stock->perPage() }}</td>
                                    <td>{{ $item->stocknumber }}</td>
                                    <td>{{ $item->cabangid }}</td>
                                    <td>{{ $item->departemenid }}</td>
                                    <td>{{ $item->jenisid }}</td>
                                    <td>{{ $item->tanggalbeli }}</td>
                                    <td>{{ $item->nomorurut }}</td>
                                    <td>{{ $item->diperiksaoleh }}</td>
                                    <td>{{ $item->tanggalperiksa }}</td>
                                    <td>
                                        <x-action :item="$item" />
                                    </td>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $Stock->links() }}
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection