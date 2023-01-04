@extends('layouts.app')

@push('scripts')
<script src="https://js.recurly.com/v4/recurly.js"></script>
<link href="https://js.recurly.com/v4/recurly.css" rel="stylesheet" type="text/css">  
<script>

recurly.configure('{{ env('RECURLY_PUBLIC_KEY') }}');

const elements = recurly.Elements();
const cardElement = elements.CardElement();
cardElement.attach('#recurly-elements');

const checkoutPricing = recurly.Pricing.Checkout();

checkoutPricing.attach('#my-checkout');

// For debugging: when pricing changes or emits an error, we'll just send it to the console
// This should be disabled or removed for your production environment
if (console) {
    checkoutPricing.on('change', function (price) { console.info(price); });
    checkoutPricing.on('error', function (e) { console.error(e); });
}
checkoutPricing.on('set.coupon', function (price) { 
    $('#coupon-errors').removeClass().addClass('alert alert-success').text('Coupon successfully applied').show();
});
checkoutPricing.on('unset.coupon', function (e) { 
    $('#coupon-errors').removeClass().addClass('alert alert-info').text('Coupon removed').show();
});
checkoutPricing.on('error.coupon', function (e) { 
    $('#coupon-errors').removeClass().addClass('alert alert-danger').text(e.message).show();
});
</script>
@endpush

@section('content')
<div class="row mb-5 gx-5 justify-content-center">
    <div class="col-lg-10 col-xl-7">
        <div class="text-center">
            <h1 class="display-4 fw-normal">Checkout</h1>
            <p class="fs-5 text-muted">Welcome, from this page you can view and edit your profile and manage your subscription plan. You can also view and access any invoices.</p>
        </div>
    </div>
</div>
<form action="{{ route('subscribe', $plan->getId()) }}" method="post" id="recurly-subscribe-card" novalidate="novalidate">
    <div class="row gx-5">
        <div class="col-lg-12 mb-5">
            <h2 class="fw-bolder mt-4">Your Details</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">First Name</label>
                            <input type="text" data-recurly="first_name" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Last Name</label>
                            <input type="text" data-recurly="last_name" class="form-control" id="inputPassword4">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Email</label>
                            <input type="text" data-recurly="last_name" class="form-control" id="inputAddress" value="{{ Auth::user()->email }}" disabled="disabled">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Company / Organisation Name</label>
                            <input type="text" data-recurly="first_name" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">VAT Number</label>
                            <input type="text" data-recurly="last_name" class="form-control" id="inputPassword4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-5">
        <div class="col-lg-12 mb-5">
            <h2 class="fw-bolder mt-4">Payment Information</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Credit Card</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Paypal</a>
                        </li>
                    </ul>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Payment Card</label>
                            <div id="recurly-elements">
                            <!-- Recurly Elements will be attached here -->
                            </div> 
                        </div>

                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress2" class="form-label">Address 2</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                        </div>
                        <div class="col-md-6">
                            <label for="inputCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">State</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputZip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-5">
        <div class="col-lg-12 mb-5">
            <h2 class="fw-bolder mt-4">Subscription Summary</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        {{ $plan->getName() }}
                    </div>
                    <section id="my-checkout">
                        <!--<div class="row g-3">
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Coupon</label>
                                <div class="input-group mb-3">
                                    <input type="text" data-recurly="coupon" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Apply</button>
                                </div>
                                <div id="coupon-errors" class="alert" role="alert"></div>
                            </div>
                        </div>-->
                        <div class="d-flex bg-light rounded mb-2 p-2 px-3">
                            <div class="flex-grow-1">Plan</div>
                            <div class="text-end">
                                <span data-recurly="currency_symbol"></span>
                                <span data-recurly="plan_now">0.00</span>
                                <small><span data-recurly="currency_code"></span></small>
                            </div>
                        </div>
                        <div class="d-flex bg-light rounded mb-2 p-2 px-3">
                            <div class="flex-grow-1">Discount</div>
                            <div class="text-end">
                                <span data-recurly="currency_symbol"></span>
                                <span data-recurly="discount_now">0.00</span>
                                <small><span data-recurly="currency_code"></span></small>
                            </div>
                        </div>
                        <div class="d-flex bg-light rounded mb-2 p-2 px-3">
                            <div class="flex-grow-1">Subtotal</div>
                            <div class="text-end">
                                <span data-recurly="currency_symbol"></span>
                                <span data-recurly="subtotal_now">0.00</span>
                                <small><span data-recurly="currency_code"></span></small>
                            </div>
                        </div>
                        <div class="d-flex bg-light rounded mb-2 p-2 px-3">
                            <div class="flex-grow-1">Tax</div>
                            <div class="text-end">
                                <span data-recurly="currency_symbol"></span>
                                <span data-recurly="tax_now">0.00</span>
                                <small><span data-recurly="currency_code"></span></small>
                            </div>
                        </div>
                        <div class="d-flex bg-light rounded mb-2 p-3 fw-bolder">
                            <div class="flex-grow-1">Order Total</div>
                            <div class="text-end">
                                <span data-recurly="currency_symbol"></span>
                                <span data-recurly="total_now">0.00</span>
                                <small><span data-recurly="currency_code"></span></small>
                            </div>
                        </div>
                    </section>   
                    <div class="row g-3 my-3">
                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">I accept the <a target="_blank" rel="nofollow noopener" href="">Privacy Policy</a> and <a target="_blank" rel="nofollow noopener" href="">Terms of Service</a></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-lg btn-info">Subscribe</button> 
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="recurly-token" data-recurly="token">  
<input type="hidden" data-recurly="plan" value="{{ $plan->getCode() }}">    
<input type="hidden" data-recurly="plan_quantity" id="plan_quantity" value="1">    
<input type="hidden" data-recurly="currency" id="currency" value="GBP">      
</form>  
@endsection
