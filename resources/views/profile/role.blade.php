@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="header bg-primary text-white py-3 text-center">
                <h1>Manage Roles</h1>
            </div>
        </div>
    </div>

    <!-- Sidebar and Main Content -->
    <div class="row mt-3">
        <!-- Include Sidebar Component -->
        <x-sidebar />
        <!-- Main Content -->
        <div class="col-md-9">
            <div class="main-content bg-white p-4 rounded">                
                
                @if(Auth::user()->can('create role' ))
                <!-- Create New Role Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Role List</h2>
                    <a href="{{ route('roles.create') }}" class="btn btn-success">Create New Role</a>
                </div>
                @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                <!-- Role Table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        {{ $role->permissions->pluck('name')->join(', ') }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown">
                                                @if(Auth::user()->can('edit role'))
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                                </li>
                                                @endif
                                                @if(Auth::user()->can('delete role'))
                                                <li>
                                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $role->id }}">Delete</button>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                        
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $role->name }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                Are you sure you want to delete the role <strong>{{ $role->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $roles->links() }}
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection