@extends('layouts.frontend')

@section('content')

{{-- Banner Section --}}
<section class="banner-service position-relative" style="margin-top:0px;">
    <div class="position-relative" style="height:350px; overflow:hidden;">
        <img src="{{ asset('assets/images/banner/banner-about.jpg') }}" 
             alt="Banner About" 
             class="w-100 h-100"
             style="object-fit:cover; object-position:center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" 
             style="background: linear-gradient(135deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.6) 100%);"></div>
    </div>
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100">
        <div class="container">
            <h1 class="display-5 fw-light mb-3" 
                style="letter-spacing: -1px; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                {{ __('frontend.about') }}
            </h1>
            <p class="fw-light mb-0 text-white" 
               style="font-weight:300; max-width:600px; margin:0 auto; line-height:1.6; 
                      text-shadow:0 1px 2px rgba(0,0,0,0.3);">
                {{ $homeTeam->{'description_'.app()->getLocale()} }}
            </p>
        </div>
    </div>
</section>

{{-- Omnilegal About Section --}}
<section id="about" class="py-5 bg-light">
    <div class="container">
      
        <div class="mb-5">
            <div class="row align-items-center justify-content-center">
                
                {{-- Logo --}}
                <div class="col-md-3 text-center mb-3 mb-md-0">
                    <img src="{{ asset('assets/images/logo.png') }}" 
                         alt="Omnilegal Logo" 
                         class="img-fluid" 
                         style="max-height:150px;">
                </div>

                {{-- Text Content --}}
                <div class="col-md-7">
                    <h2 class="fw-bold mb-3">
                        {{ $homeAbout->{'title_'.app()->getLocale()} ?? '' }}
                    </h2>
                    <p class="text-muted" style="line-height:1.8;">
                        {!! $descriptions->{'about_'.app()->getLocale()} ?? '' !!}
                    </p>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- Modern Horizontal Team Section -->
<section class="team-section py-5 bg-white">
    <div class="container">

        <!-- Section Title -->
        <div class="text-center mb-5">
            <h2 class="text-primary fw-bold mb-3">{{ $homeTeam->title }}</h2>
            <div class="mx-auto" style="width: 60px; height: 4px; background: linear-gradient(to right, #007bff, #0056b3);"></div>
        </div>

        <!-- Horizontal Team Cards -->
        <div class="team-container">
            @foreach($teams as $index => $team)
                <div class="team-card-horizontal shadow-sm border-0 rounded-3 overflow-hidden mb-4" style="transition: all 0.3s ease;">
                    <div class="row g-0 align-items-center">
                        
                        <!-- Team Member Image -->
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="team-image-container position-relative d-flex align-items-center justify-content-center p-3" 
                                 style="min-height: 200px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                                <img src="{{ $team->image_url }}" 
                                     alt="{{ $team->name }}" 
                                     class="img-fluid rounded-3 shadow-sm team-profile-img" 
                                     style="max-height: 280px; max-width: 100%; object-fit: contain; transition: transform 0.3s ease;">
                                <div class="team-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center rounded-3" 
                                     style="background: rgba(0,123,255,0.9); opacity: 0; transition: opacity 0.3s ease;">
                                    <div class="text-white text-center">
                                        <i class="fas fa-envelope fa-2x mb-2"></i>
                                        <p class="mb-0 fw-medium">Contact Me</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Member Info -->
                        <div class="col-12 col-md-8 col-lg-9">
                            <div class="card-body p-4 p-lg-5">
                                
                                <!-- Name and Email Header -->
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start mb-3">
                                    <div>
                                        <h4 class="fw-bold text-dark mb-1">{{ $team->name }}</h4>
                                        <div class="d-flex align-items-center text-primary">
                                            <i class="fas fa-envelope me-2"></i>
                                            <a href="mailto:{{ $team->email }}" 
                                               class="text-decoration-none fw-medium email-link">
                                                {{ $team->email }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description with Read More/Less -->
                                <div class="team-description">
                                    <div class="description-content">
                                        <p class="text-muted mb-3" 
                                           id="desc-{{ $index }}" 
                                           style="line-height: 1.7; font-size: 1rem;">
                                            {{ Str::limit($team->{'description_'.app()->getLocale()} ?? $team->description, 200, '...') }}
                                        </p>
                                        
                                        @if(strlen($team->{'description_'.app()->getLocale()} ?? $team->description) > 200)
                                            <!-- Full Description (Hidden by default) -->
                                            <p class="text-muted mb-3 d-none" 
                                               id="full-desc-{{ $index }}" 
                                               style="line-height: 1.7; font-size: 1rem;">
                                                {{ $team->{'description_'.app()->getLocale()} ?? $team->description }}
                                            </p>
                                        @endif
                                    </div>
                                    
                                    @if(strlen($team->{'description_'.app()->getLocale()} ?? $team->description) > 200)
                                        <!-- Read More/Less Button -->
                                        <button class="btn btn-link p-0 text-primary fw-medium border-0 bg-transparent read-more-btn" 
                                                data-index="{{ $index }}" 
                                                data-read-more="{{ __('frontend.read-more') }}"
                                                data-read-less="{{ __('frontend.read-less') }}"
                                                data-expanded="false"
                                                style="font-size: 0.95rem; text-decoration: none;">
                                            <i class="fas fa-chevron-down me-1 chevron-icon"></i>
                                            {{ __('frontend.read-more') }}
                                        </button>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<section class="py-8 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-primary mb-4"style="margin-top:2rem;">Disclaimer</h2>

                    <div class="bg-white rounded-3 shadow-sm p-5">
                        <small>
                            {!! $descriptions->{'disclaimer_'.app()->getLocale()} ?? '' !!}
                        </small>


                        <hr class="my-4 opacity-25">

                        <div class="d-flex justify-content-center mt-4">
                            <a href="{{ locale_route('frontend.disclaimer') }}" 
                               class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm">
                                <i class="fas fa-info-circle me-2"></i>
                                {{ __('frontend.check-disclaimer') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const readMoreBtns = document.querySelectorAll('.read-more-btn');
    
    readMoreBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const index = this.getAttribute('data-index');
            const readMoreText = this.getAttribute('data-read-more');
            const readLessText = this.getAttribute('data-read-less');
            const shortDesc = document.getElementById('desc-' + index);
            const fullDesc = document.getElementById('full-desc-' + index);
            const chevronIcon = this.querySelector('.chevron-icon');
            
            if (fullDesc.classList.contains('d-none')) {
                // Show full description
                shortDesc.classList.add('d-none');
                fullDesc.classList.remove('d-none');
                this.setAttribute('data-expanded', 'true');
                
                // Update button text only
                this.innerHTML = '<i class="fas fa-chevron-down me-1 chevron-icon"></i>' + readLessText;
            } else {
                // Show short description
                fullDesc.classList.add('d-none');
                shortDesc.classList.remove('d-none');
                this.setAttribute('data-expanded', 'false');
                
                // Update button text only
                this.innerHTML = '<i class="fas fa-chevron-down me-1 chevron-icon"></i>' + readMoreText;
            }
        });
    });
});
</script>

@endsection