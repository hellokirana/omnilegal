@extends('layouts.frontend')

@section('content')

{{-- Banner Section - Elegant Simple with Photo --}}
<section class="banner-service position-relative" style="margin-top:0px;">
    {{-- Background image with overlay --}}
    <div class="position-relative" style="height:450px; overflow:hidden;">
        <img src="{{ asset('assets/images/banner/banner-service.jpg') }}" 
             alt="Banner" 
             class="w-100 h-100"
             style="object-fit:cover; object-position:center;">
        
        {{-- Elegant overlay --}}
        <div class="position-absolute top-0 start-0 w-100 h-100" 
             style="background: linear-gradient(135deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.6) 100%);"></div>
    </div>
    
    {{-- Content overlay --}}
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-light mb-3" 
                        style="letter-spacing: -1px; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                        {{ $homeServiceAndPracticeAreas->{'title_'.app()->getLocale()} }}
                    </h1>
                    
                    <p class="fw-light mb-0 text-white" 
                       style="font-weight: 300; max-width: 600px; margin: 0 auto; line-height: 1.6; 
                              text-shadow: 0 1px 2px rgba(0,0,0,0.3);">
                        {{ $homeServiceAndPracticeAreas->{'description_'.app()->getLocale()} }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Subtle bottom accent --}}
    <div class="position-absolute bottom-0 start-0 w-100" 
         style="height: 2px; background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,0.3) 50%, transparent 100%);"></div>
</section>


<div class="container py-5">
    {{-- Services Section --}}
    <div class="mb-5">
        <h2 class="text-center mb-4">
            {{ __('frontend.services-btn') }}
        </h2>

        <div class="row">
            @foreach($services as $service)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 text-center shadow-sm">
                        @if($service->image)
                            <img src="{{ asset('assets/images/service/' . $service->image) }}" 
                                 class="card-img-top mx-auto d-block p-4" 
                                 alt="{{ $service->{'title_'.app()->getLocale()} }}"
                                 style="width:auto; height:150px;">
                        @endif
                        <div class="card-body">
                            <h5 class="fw-bold text-primary">
                                {{ $service->{'title_'.app()->getLocale()} }}
                            </h5>
                            <p class="card-text">
                                {{ $service->{'description_'.app()->getLocale()} }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Practice Areas Section --}}
    <div>
        <h2 class="text-center mb-4">
            {{ __('frontend.practices-btn') }}
        </h2>

        <div class="row">
            @foreach($practiceAreas as $practiceArea)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 text-center shadow-sm">
                        @if($practiceArea->image)
                            <img src="{{ asset('assets/images/service/' . $practiceArea->image) }}" 
                                 class="card-img-top mx-auto d-block p-4" 
                                 alt="{{ $practiceArea->{'title_'.app()->getLocale()} }}"
                                 style="width:auto; height:150px;">
                        @endif
                        <div class="card-body">
                            <h5 class="fw-bold text-primary">
                                {{ $practiceArea->{'title_'.app()->getLocale()} }}
                            </h5>
                            <p class="card-text">
                                {{ $practiceArea->{'description_'.app()->getLocale()} }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
