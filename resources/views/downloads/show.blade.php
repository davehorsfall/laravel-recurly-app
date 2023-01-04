@extends('layouts.app')

@section('content')
<!-- Pricing section-->
<section class="py-5" id="pricing">
    <div class="container my-5">
        <div class="row mb-5 gx-5 justify-content-center">
            <div class="col-lg-10 col-xl-7">
                <div class="text-center">
                    <h1 class="display-4 fw-normal">{{ $download->name }}</h1>
                    <p class="fs-5 text-muted">Quickly build an effective pricing table for your potential customers with this Bootstrap example. It’s built with default Bootstrap components and utilities with little customization.</p>
                </div>
            </div>
        </div>
        <div class="row gx-5">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                    <button type="button mb-4" class="w-100 btn btn-lg btn-outline-primary">PREVIEW</button>     
                    <!-- Post content-->
                    <section class="mb-5">
                        <p class="fs-5 mb-4">Science is an enterprise that should be cherished as an activity of the free human mind. Because it transforms who we are, how we live, and it gives us an understanding of our place in the universe.</p>
                        <p class="fs-5 mb-4">The universe is large and old, and the ingredients for life as we know it are everywhere, so there's no reason to think that Earth would be unique in that regard. Whether of not the life became intelligent is a different question, and we'll see if we find that.</p>
                        <p class="fs-5 mb-4">If you get asteroids about a kilometer in size, those are large enough and carry enough energy into our system to disrupt transportation, communication, the food chains, and that can be a really bad day on Earth.</p>
                        <h2 class="fw-bolder mb-4 mt-5">I have odd cosmic thoughts every day</h2>
                        <p class="fs-5 mb-4">For me, the most fascinating interface is Twitter. I have odd cosmic thoughts every day and I realized I could hold them to myself or share them with people who might be interested.</p>
                        <p class="fs-5 mb-4">Venus has a runaway greenhouse effect. I kind of want to know what happened there because we're twirling knobs here on Earth without knowing the consequences of it. Mars once had running water. It's bone dry today. Something bad happened there as well.</p>
                    </section>
                </article>
            </div>
            <div class="col-lg-4">
                <div class="card h-100 shadow border-0">
                    <div class="card-header text-center">
                        <h1 class="card-title">FREE</h1>
                        <button type="button" class="w-100 btn btn-lg btn-outline-primary">DOWNLOAD</button>     
                    </div>
                    <div class="card-body p-4">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <h5 class="h5">Categories</h5>
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                        <h5 class="h5">Documentation</h5>
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>    
                        <h5 class="h5">Sales</h5>
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>     
                        <h5 class="h5">Comments</h5>
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>    
                        <h5 class="h5">Rating</h5>
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>    
                        <h5 class="h5">Share</h5>
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>                                       
                    </div>                  
                    <div class="card-footer p-4">
                        <div class="d-flex align-items-end justify-content-between">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                <div class="small">
                                    <div class="fw-bold">Kelly Rowan</div>
                                    <div class="text-muted">March 12, 2021 &middot; 6 min read</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</section>
@endsection
