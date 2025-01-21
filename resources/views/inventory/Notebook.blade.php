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
                <h2 class="mb-4">Notebook List</h2>
                <!-- Filter Button -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                    Open Filters
                </button>

                <!-- Include the Modal Component -->
                <x-filter-modal :route="request()->url()" />

                <a href="{{ route('inventory.notebook') }}" class="btn btn-secondary">
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
                                <th>Processor</th>
                                <th>Merk</th>
                                <th>Memory</th>
                                <th>Harddisk</th>
                                <th>DVD/CD RW</th>
                                <th>Layar</th>
                                <th>WiFi</th>
                                <th>Webcam</th>
                                <th>Tas</th>
                                <th>OS</th>
                                <th>Anti Virus</th>
                                <th>Office</th>
                                <th>IP</th>
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
                            @foreach ($Notebook as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->stocknumber }}</td>
                                    <td>{{ $item->kelompok }}</td>
                                    <td>{{ $item->processor }}</td>
                                    <td>{{ $item->merk }}</td>
                                    <td>{{ $item->memory }}</td>
                                    <td>{{ $item->harddisk }}</td>
                                    <td>{{ $item->dvd_cd_rw }}</td>
                                    <td>{{ $item->layar }}</td>
                                    <td>{{ $item->wifi }}</td>
                                    <td>{{ $item->webcam }}</td>
                                    <td>{{ $item->tas }}</td>
                                    <td>{{ $item->os }}</td>
                                    <td>{{ $item->antivirus }}</td>
                                    <td>{{ $item->office }}</td>
                                    <td>{{ $item->ip }}</td>
                                    <td>{{ $item->user  }}</td>
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
                    {{ $Notebook->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
