@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row">
        <div class="col-12">
            <div class="header bg-primary text-white py-3 text-center">
                <h1>Edit User</h1>
            </div>
        </div>
    </div>

    <!-- Sidebar and Main Content -->
    <div class="row mt-3">
        <!-- Include Sidebar Component -->
        <x-sidebar />
        <div class="col-md-9">
            <div class="main-content bg-white p-4 rounded">
                <h1>Edit User: {{ $user->name }}</h1>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Username -->
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input 
                                type="text" 
                                class="form-control @error('username') is-invalid @enderror" 
                                id="username" 
                                name="username" 
                                value="{{ old('username', $user->username) }}" 
                                required
                            >
                            @error('username')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $user->name) }}" 
                                required
                            >
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password">Password (Kosongkan jika masih ingin menggunakan password lama)</label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password"
                            >
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select 
                                class="form-control @error('role') is-invalid @enderror" 
                                id="role" 
                                name="role" 
                                required
                            >
                                @foreach($roles as $role)
                                    <option 
                                        value="{{ $role->name }}" 
                                        @if($user->roles->pluck('name')->contains($role->name)) selected @endif
                                    >
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
