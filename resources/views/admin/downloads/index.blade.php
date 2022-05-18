@extends('layouts.app')

@section('content')
<div class="row gx-5">
    <div class="col-lg-12 mb-5">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h2 class="fw-bolder mt-4">Download Management</h2>
            <a href="{{ route('admin.downloads.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add Download</a>
        </div>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Admin</a></li>
            <li class="breadcrumb-item active">Downloads</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form class="form-inline col-lg-12" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" id="filter" name="filter" class="form-control" placeholder="Search for downloads by name" value="{{ $filter }}">
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
                            <th scope="col">Tags</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($downloads as $download)
                            <tr>
                                <th scope="row">{{ $download->id }}</th>
                                <td>{{ $download->name }}</td>
                                <td>
                                    @foreach($download->tags as $tag)
                                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('edit-downloads')
                                    <a href="{{ route('admin.downloads.edit', $download->id) }}" class="btn btn-primary btn-sm me-2 float-start">Edit</a>
                                    @endcan
                                    @can('delete-downloads')
                                    <form action="{{ route('admin.downloads.destroy', $download) }}" method="POST" class="float-start">
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
                    {{ $downloads->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
