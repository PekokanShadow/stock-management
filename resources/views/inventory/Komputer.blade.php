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
                <h2 class="mb-4">CPU List</h2>
                <!-- Filter Button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                    Open Filters
                </button>

                <!-- Include the Modal Component -->
                <x-filter-modal :route="request()->url()" />

                <a href="{{ route('inventory.komputer') }}" class="btn btn-secondary">
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
                                <th>Kelompok</th>
                                <th>Processor</th>
                                <th>Motherboard</th>
                                <th>Memory</th>
                                <th>Harddisk</th>
                                <th>Lan Card</th>
                                <th>VGA Card</th>
                                <th>Mouse</th>
                                <th>Keyboard</th>
                                <th>OS</th>
                                <th>Anti Virus</th>
                                <th>Office</th>
                                <th>IP</th>
                                <th>User</th>
                                <th>Departemen</th>
                                <th>Bagian</th>
                                <th>Exp. Anti Virus</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Harga</th>
                                <th>Keterangan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Komputer as $index => $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($Komputer->currentPage() - 1) * $Komputer->perPage() }}</td>
                                    <td>{{ $item->stocknumber }}</td>
                                    <td>{{ $item->kelompok }}</td>
                                    <td>{{ $item->processor }}</td>
                                    <td>{{ $item->motherboard }}</td>
                                    <td>{{ $item->memory }}</td>
                                    <td>{{ $item->harddisk }}</td>
                                    <td>{{ $item->lancard }}</td>
                                    <td>{{ $item->vgacard }}</td>
                                    <td>{{ $item->mouse }}</td>
                                    <td>{{ $item->keyboard }}</td>
                                    <td>{{ $item->os }}</td>
                                    <td>{{ $item->antivirus }}</td>
                                    <td>{{ $item->office }}</td>
                                    <td>{{ $item->ip }}</td>
                                    <td>{{ $item->user }}</td>
                                    <td>{{ $item->departemenid }}</td>
                                    <td>{{ $item->bagian }}</td>
                                    <td>{{ $item->expantivirus }}</td>
                                    <td>{{ $item->tanggalmasuk }}</td>
                                    <td>{{ $item->tanggalkeluar }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>
                                        <x-action :item="$item" />
                                    </td>  
                                    
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 <!-- Pagination Links -->
                 <div class="d-flex justify-content-center mt-3">
                    {{ $Komputer->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection