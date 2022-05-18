@extends('layouts.app')

@section('content')
<div class="row gx-5">
    <div class="col-lg-12 mb-5">
        <h2 class="fw-bolder mt-4">User Management</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Admin</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form class="form-inline col-lg-12" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" id="filter" name="filter" class="form-control" placeholder="Search for users by name or email address" value="{{ $filter }}">
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">@sortablelink('id', '#')</th>
                            <th scope="col">@sortablelink('name')</th>
                            <th scope="col">@sortablelink('email')</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles()->get()->pluck('name')->toArray() as $role)
                                        <span class="badge bg-secondary">{{ $role }}</span>
                                    @endforeach 
                                </td>
                                <td>
                                    @can('edit-users')
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm me-2 float-start">Edit</a>
                                    @endcan
                                    @can('delete-users')
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-start">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-primary btn-sm me-2 ">Delete</button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>                            
                        @endforeach                           
                    </tbody>
                </table>     
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

