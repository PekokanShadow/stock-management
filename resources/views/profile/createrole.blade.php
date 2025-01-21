@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="header bg-primary text-white py-3 text-center">
                <h1>Create Role</h1>
            </div>
        </div>
    </div>

    <!-- Sidebar and Main Content -->
    <div class="row mt-3">
       <!-- Include Sidebar Component -->
       <x-sidebar />
        <div class="col-md-9">
            <div class="main-content bg-white p-4 rounded">
            <h1>Create New Role</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('role.index') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="name">Role Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="permissions">Permissions</label>
                
                    <!-- Select All Checkbox -->
                    <div class="form-check mb-2">
                        <input 
                            type="checkbox" 
                            id="select-all" 
                            class="form-check-input"
                        >
                        <label class="form-check-label" for="select-all">Select All</label>
                    </div>
                
                    <!-- Individual Permissions -->
                    <div class="row">
                        @foreach ($permissions as $permission)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input 
                                        type="checkbox" 
                                        name="permissions[]" 
                                        value="{{ $permission->name }}" 
                                        id="permission-{{ $permission->id }}" 
                                        class="form-check-input"
                                    >
                                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Include JavaScript for "Select All" functionality -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const selectAllCheckbox = document.getElementById('select-all');
                        const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');
                
                        selectAllCheckbox.addEventListener('change', function () {
                            permissionCheckboxes.forEach(checkbox => {
                                checkbox.checked = selectAllCheckbox.checked;
                            });
                        });
                    });
                </script>
                

                <button type="submit" class="btn btn-primary">Create Role</button>
            </form>
        </div>
        </div>

    </div>
</div>
@endsection
