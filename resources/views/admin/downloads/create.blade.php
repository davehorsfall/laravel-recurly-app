@extends('layouts.app')

@section('content')
<div class="row gx-5">
    <div class="col-lg-12 mb-5">
        <h2 class="fw-bolder mt-4">Add Download</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('admin.downloads.index') }}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.downloads.index') }}">Downloads</a></li>
            <li class="breadcrumb-item active">New</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                {{ Form::open(array('route' => 'admin.downloads.store', 'method' => 'post')) }}
                    @csrf
                    <div class="form-group mb-3 row">
                        {{ Form::label('name', __('Name'), array('class' => 'col-md-4 col-form-label text-md-right')) }}
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>  
                    <div class="form-group mb-3 row">
                        {{ Form::label('filename', __('Filename'), array('class' => 'col-md-4 col-form-label text-md-right')) }}
                        <div class="col-md-6">
                            <select id="filename" class="form-control @error('filename') is-invalid @enderror"
                                name="filename" required autocomplete="none" autofocus>
                                <option value="">- Select file -</option>
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>
                            @error('filename')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>                                                                 
                    <div class="form-group mb-3 row">
                        {{ Form::label('tags', __('Tags'), array('class' => 'col-md-4 col-form-label text-md-right')) }}
                        <div class="col-md-6">   
                            <input id="tags" type="text" data-role="tagsinput" class="form-control tags @error('tags') is-invalid @enderror"
                                    name="tags" value="" required autocomplete="none" autofocus>                                                 
                            @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>                                                                                    
                    {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection