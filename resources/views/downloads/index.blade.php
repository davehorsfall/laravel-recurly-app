@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Downloads') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($downloads as  $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->filename }}</td>
                                <td>
                                    <a href="{{ route('downloads.show', $user->id) }}" class="btn btn-info">View More</a>
                                </td>
                            </tr>                            
                            @endforeach                            
                        </tbody>
                    </table>                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
