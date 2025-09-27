@extends('layouts.frontend')

@section('content')
{{-- Banner Section --}}
<section class="banner-service position-relative" style="margin-top:0px;" data-aos="fade-right" data-aos-duration="1200">
    <div class="position-relative" style="height:350px; overflow:hidden;">
        <img src="{{ asset('assets/images/banner/banner-about.jpg') }}" 
             alt="Banner Contact" 
             class="w-100 h-100"
             style="object-fit:cover; object-position:center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" 
             style="background: linear-gradient(135deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.6) 100%);"></div>
    </div>
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100">
        <div class="container" data-aos="fade-up" data-aos-delay="200">
            <h1 class="display-5 fw-light mb-3" 
                style="letter-spacing: -1px; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                {{ __('frontend.contact') }}
            </h1>
        </div>
    </div>
</section>

{{-- Contact Form --}}
<section class="contact py-8">
    <div class="container">
        <div class="row align-items-center g-5">
            {{-- Left Side --}}
            <div class="col-lg-5" data-aos="fade-up">
                <div class="text-center">
                    <div class="contact-icon mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                            <i class="fas fa-paper-plane text-primary" style="font-size: 3rem;"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-3">{{ __('frontend.get_in_touch') }}</h2>
                    <p class="text-muted mb-4">{{ __('frontend.contact_description') }}</p>
                </div>
            </div>
            
            {{-- Right Side - Form --}}
            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white rounded-3 shadow-sm p-5">
                    <h3 id="send-message" class="fw-bold mb-4">{{ __('frontend.send-message') }}</h3>
                    
                    {{-- Alerts --}}
                    @if (Session::has('success'))
                        <div class="alert alert-success" data-aos="fade-up">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('warning'))
                        <div class="alert alert-danger" data-aos="fade-up">
                            {{ Session::get('warning') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ locale_route('frontend.send-contact') }}" data-aos="fade-up" data-aos-delay="200">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">{{ __('frontend.full_name') }}</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">{{ __('frontend.your_email') }}</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <label class="form-label">{{ __('frontend.subject') }}</label>
                            <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
                        </div>
                        
                        <div class="mt-3">
                            <label class="form-label">{{ __('frontend.your_message') }}</label>
                            <textarea name="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
                        </div>
                        
                        <div class="form-check mt-3">
                            <input type="checkbox" class="form-check-input" id="term" required>
                            <label class="form-check-label" for="term">{{ __('frontend.confirm_info') }}</label>
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill">
                                {{ __('frontend.submit_message') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Contact Info --}}
<section class="contact-details py-5">
    <div class="container">
        <div class="row g-4 justify-content-center text-center">
            <div class="col-md-4" data-aos="fade-up">
                <div class="contact-card h-100 p-4 rounded shadow-sm contact-card-hover">
                    <i class="fas fa-envelope fa-2x text-primary mb-2"></i>
                    <h5>Email</h5>
                    <a href="mailto:{{ $website->email }}" class="text-dark text-decoration-none">{{ $website->email }}</a>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="contact-card h-100 p-4 rounded shadow-sm contact-card-hover">
                    <i class="fas fa-phone fa-2x text-primary mb-2"></i>
                    <h5>Phone</h5>
                    <a href="tel:{{ $website->phone }}" class="text-dark text-decoration-none">{{ $website->phone ?? '-' }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Google Map --}}
<section class="contact-map" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        {!! $website->maps ?? '' !!}
    </div>
</section>

@push('styles')
<style>
    /* Hover zoom for contact cards */
    .contact-card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .contact-card-hover:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }
</style>
@endpush
@endsection
