@extends('layouts.app')

@section('content')
<!-- Pricing section-->
<section class="py-5" id="pricing">
    <div class="container my-5">
        <div class="row mb-5 gx-5 justify-content-center">
            <div class="col-lg-10 col-xl-7">
                <div class="text-center">
                    <h1 class="display-4 fw-normal">Subscription Plans</h1>
                    <p class="fs-5 text-muted">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            @foreach ($plans as $plan)
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">{{ $plan->getName() }}</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                        <li>10 users included</li>
                        <li>2 GB of storage</li>
                        <li>Email support</li>
                        <li>Help center access</li>
                        </ul>
                        <a href="{{ route('subscribe', ['id' => $plan->getId()]) }}" class="w-100 btn btn-lg btn-outline-primary">{{ __('Subscribe') }}</a>   
                    </div>
                    </div>
                </div>            
            @endforeach  
        </div>
    </div>
</section>
@endsection
