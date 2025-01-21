@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="header bg-primary text-white py-3 text-center">
                <h1>User Management</h1>
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
                <!-- Page Title and Button -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">User List</h2>
                    @if(Auth::user()->can('create user'))
                    <a href="{{ route('profile.createuser') }}" class="btn btn-success">Create User</a>
                    @endif
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="actionsDropdown">
                                                @if(Auth::user()->can('edit user'))
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">Edit</a>
                                                </li>
                                                @endif
                                                @if(Auth::user()->can('delete user'))
                                                <li>
                                                    <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">Delete</button>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                        
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->name }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                Are you sure you want to delete the role <strong>{{ $user->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
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
                        {{ $users->links() }}
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection