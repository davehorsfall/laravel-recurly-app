@extends('layouts.app')

@section('content')
<div class="row gx-5">
    <div class="col-lg-12 mb-5">
        <h2 class="fw-bolder mt-4">Edit Account</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
            <li class="breadcrumb-item active">{{ $user->name }}</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                {{ Form::open(array('route' => array('account.edit'), 'method' => 'post')) }}
                    @csrf
                    <div class="form-group mb-3 row">
                        {{ Form::label('email', __('E-Mail Address'), array('class' => 'col-md-4 col-form-label text-md-right')) }}
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                    <div class="form-group mb-3 row">
                        {{ Form::label('name', __('Name'), array('class' => 'col-md-4 col-form-label text-md-right')) }}
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('email') is-invalid @enderror"
                                name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>                            
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>                                                                                                                                    
                    {{ method_field('PUT') }}
                    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
