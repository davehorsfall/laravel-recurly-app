@extends('layouts.app')

@section('content')
<div class="row mb-5 gx-5 justify-content-center">
    <div class="col-lg-10 col-xl-7">
        <div class="text-center">
            <h1 class="display-4 fw-normal">Account Overview</h1>
            <p class="fs-5 text-muted">Welcome, from this page you can view and edit your profile and manage your subscription plan. You can also view and access any invoices.</p>
        </div>
    </div>
</div>
<div class="row row-cols-1 row-cols-md-2 mb-3 text-center">
    <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm h-100">
            <div class="card-header py-3">
                <h4 class="my-0 fw-normal">Profile</h4>
            </div>
            <div class="card-body">               
                <dl class="row text-start">
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ Auth::user()->name }}</dd>

                    <dt class="col-sm-3">Email</dt>
                    <dd class="col-sm-9">{{ Auth::user()->email }}</dd>

                    <dt class="col-sm-3">Registered</dt>
                    <dd class="col-sm-9">{{ Auth::user()->created_at->format('j F, Y') }}</dd>
                </dl>                
            </div>  
            <div class="card-footer text-muted">
                <div class="btn-group d-flex" role="group" aria-label="Profile">
                    <a href="{{ route('account.edit', 0) }}" class="btn btn-lg btn-outline-primary flex-fill">Edit Profile</a>
                </div>  
            </div>                                     
        </div>
    </div>
    <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm h-100">
            <div class="card-header py-3">
                <h4 class="my-0 fw-normal">Active Plan</h4>
            </div>
            @if ($active)
            <div class="card-body">
                <h1 class="card-title pricing-card-title">{{ $active->getName() }}</h1>
                <p class="card-text">Your next bill is for £9.99 on 01/03/2021.</p>
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <p class="card-text">Your card ending in 1358</p>
                                <p class="card-text muted">Expires: 07/2022</p>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-primary">UPDATE</a>
                            </div>
                        </div>
                    </div>
                </div>                      
            </div>
            <div class="card-footer text-muted">
                <div class="btn-group d-flex" role="group" aria-label="Profile">
                    <button type="button" class="btn btn-lg btn-outline-primary w-100">Cancel</button>
                    <button type="button" class="btn btn-lg btn-outline-primary w-100">Change</button>
                    <button type="button" class="btn btn-lg btn-outline-primary w-100">Update</button>
                </div>
            </div>  
            @else
            <div class="card-body">
                <div class="alert alert-primary" role="alert">
                    You don't have an active subscription. 
                </div>                     
            </div>
            <div class="card-footer text-muted">
                <div class="btn-group d-flex" role="group">
                    <a href="{{ route('pricing') }}" class="btn btn-lg btn-outline-primary flex-fill">Subscribe</a>
                </div>
            </div>  
            @endif
        </div>
    </div>
</div>

@if ($subscriptions)
<div class="row my-5 gx-5 justify-content-center">
    <div class="col-lg-10 col-xl-7">
        <div class="text-center">
            <h1 class="display-6 fw-normal">Subscription Plans</h1>
            <p class="fs-5 text-muted">Here is a list of all your active and previous subscription plans. <a href="{{ route('invoices.index') }}" class="">Looking for invoices</a>?</p>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table text-center">
        <thead>      
        <tr>
            <th>Plan</th>
            <th>Status</th>
            <th>Created</th>
            <th>Expired</th>
            <th>Reason</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($subscriptions as $subscription)
            <tr>
                <th scope="row" class="text-start">{{ $subscription->getPlan()->getName() }}</th>                      
                <td>{{ date('d/m/Y', strtotime($subscription->getCreatedAt())) }}</td>
                <td>{{ date('d/m/Y', strtotime($subscription->getExpiresAt())) }}</td>
                <td>{!! App\Http\Helpers\RecurlyHelper::getBadge($subscription->getState()) !!}</td>
                <td>{!! App\Http\Helpers\RecurlyHelper::getBadge($subscription->getExpirationReason()) !!}</td>
            </tr>            
        @endforeach   
        <tr>
        </tbody>
    </table>
</div>
@endif  

@endsection
