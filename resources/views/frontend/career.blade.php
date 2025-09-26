@extends('layouts.frontend')

@section('content')
{{-- Banner Section --}}
<section class="banner-service position-relative" style="margin-top:0px;">
    <div class="position-relative" style="height:350px; overflow:hidden;">
        <img src="{{ asset('assets/images/banner/banner-about.jpg') }}" 
             alt="Banner Contact" 
             class="w-100 h-100"
             style="object-fit:cover; object-position:center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" 
             style="background: linear-gradient(135deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.6) 100%);"></div>
    </div>
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100">
        <div class="container">
            <h1 class="display-5 fw-light mb-3" 
                style="letter-spacing: -1px; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
               {{ $homeCareer->{'title_'.app()->getLocale()} }}
            </h1>
            <p class="fw-light mb-0 text-white" 
               style="font-weight:300; max-width:600px; margin:0 auto; line-height:1.6; 
                      text-shadow:0 1px 2px rgba(0,0,0,0.3);">
                {{ $homeCareer->{'description_'.app()->getLocale()} }}
            </p>
        </div>
    </div>
</section>
<section class="career py-8">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white rounded-3 shadow-sm p-5">
                    <h2 class="fw-bold mb-4 text-center">{{ __('frontend.join_our_team') }}</h2>
                    <p class="career-description text-muted text-center mb-4" style="text-align: center">
                       {!! $description->{'career_'.app()->getLocale()} !!}
                    </p>
                    {{-- Alerts --}}
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @if(Session::has('file_url'))
                                <br>
                                <a href="{{ Session::get('file_url') }}" target="_blank">
                                    {{ Session::get('file_name') }}
                                </a>
                            @endif
                        </div>
                    @endif
                    @if (Session::has('warning'))
                        <div class="alert alert-danger">
                            {{ Session::get('warning') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ locale_route('frontend.send-career') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">{{ __('frontend.full_name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('frontend.your_email') }}</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('frontend.subject') }}</label>
                            <input type="text" name="subject" class="form-control" value="{{ old('subject') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('frontend.your_message') }}</label>
                            <textarea name="message" class="form-control" rows="5">{{ old('message') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('frontend.upload_resume') }}</label>
                            <input type="file" name="aplication" class="form-control" accept=".pdf,.doc,.docx">
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="term" required>
                            <label class="form-check-label" for="term">
                                {{ __('frontend.confirm_info') }}
                            </label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                {{ __('frontend.submit_application') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- Contact Info (mirip footer) --}}
<section class="contact-details py-5">
    <div class="container">
        <div class="row g-4 justify-content-center text-center">
            <div class="col-md-4">
                <div class="contact-card h-100 p-4 rounded shadow-sm">
                    <i class="fas fa-envelope fa-2x text-primary mb-2"></i>
                    <h5>Email</h5>
                    <a href="mailto:{{ $website->email }}" class="text-dark text-decoration-none">{{ $website->email }}</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card h-100 p-4 rounded shadow-sm">
                    <i class="fas fa-phone fa-2x text-primary mb-2"></i>
                    <h5>Phone</h5>
                    <a href="tel:{{ $website->phone }}" class="text-dark text-decoration-none">{{ $website->phone ?? '-' }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Google Map --}}
<section class="contact-map">
    <div class="container">
    {!! $website->maps ?? '' !!}
</div>
</section>
@endsection
