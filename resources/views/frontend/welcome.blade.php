@extends('layouts.frontend')

@section('content')
    <!-- banner-section -->
<section class="banner-section position-relative">
    <div class="swiper-container">
        <div class="swiper single-item-carousel">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide position-relative">
                        {{-- Gambar banner --}}
                        <img src="{{ asset($slider->image_url) }}" 
                             alt="Banner {{ $loop->iteration }}" 
                             class="w-100">

                        {{-- Overlay putih transparan + gradient --}}
                        <div class="overlay-gradient"></div>

                        {{-- Konten di atas overlay --}}
                        <div class="banner-content position-absolute top-50 start-50 translate-middle text-left px-3">
                            <h1 class="fw-bold mb-3" style="color: #303192; font-size: 4rem;">
                                {{ $slider->{'title_' . app()->getLocale()} }}
                            </h1>
                            <h5 class="mb-3" style="color: #000;">
                                {{ $slider->{'description_' . app()->getLocale()} }}
                            </h5>
                            @if($slider->{'link_caption_' . app()->getLocale()})
                                <a href="{{ $slider->link ?? 'javascript:void(0)' }}" 
                                   class="btn btn-primary rounded-pill">
                                    {{ $slider->{'link_caption_' . app()->getLocale()} }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- service & practise area page -->
<section class="about-page">
    <div class="container">
        <div class="row">
            
            <!-- Left Side -->
            <div class="col-lg-5">
                <div class="about-left">
                    <h2 class="text-primary">
                        {{ $homeServiceAndPracticeAreas->title }}
                    </h2>
                    <p style="text-align: justify;">
                        {{ $homeServiceAndPracticeAreas->description }}
                    </p>

                    <!-- Switch Services/Practice -->
                    <div class="service-practice-switch mt-3">
                        <div class="sp-switch">
                            <input type="radio" id="switch-services" name="switch-tab" checked>
                            <label for="switch-services" onclick="showTab('services')">
                                {{ __('frontend.services-btn') }}
                            </label>

                            <input type="radio" id="switch-practice" name="switch-tab">
                            <label for="switch-practice" onclick="showTab('practice')">
                                {{ __('frontend.practices-btn') }}
                            </label>

                            <span class="sp-switch-highlight"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-lg-7">
                <!-- Services -->
<div id="services" class="tab-content">
    <div class="row g-4">
        @foreach($services as $service)
            <div class="col-6 col-md-3 text-center">
                <div class="service-item">
                    @if($service->image)
                        <img src="{{ asset('assets/images/service/' . $service->image) }}" 
                             alt="{{ $service->{'title_'.app()->getLocale()} }}" 
                             class="img-fluid mb-2"
                             style="width:auto; height:70px;">
                    @endif
                    <h6 class="fw-bold text-primary">
                        {{ $service->{'title_'.app()->getLocale()} }}
                    </h6>
                </div>
            </div>
        @endforeach
    </div>
    {{-- See All di tengah bawah --}}
<div class="text-center mt-3">
    <a href="{{ locale_route('frontend.service') }}" 
       class="fw-light text-primary text-decoration-none">
        {{ __('frontend.see-all') }}
    </a>
</div>
</div>

<!-- Practice Areas -->
<div id="practice" class="tab-content" style="display: none;">
    <div class="row g-4">
        @foreach($practiceAreas as $area)
            <div class="col-6 col-md-3 text-center">
                <div class="practice-item">
                    @if($area->image)
                        <img src="{{ asset('assets/images/service/' . $area->image) }}" 
                             alt="{{ $area->{'title_'.app()->getLocale()} }}" 
                             class="img-fluid mb-2"
                             style="width:auto; height:70px;">
                    @endif
                    <h6 class="fw-bold text-primary">
                        {{ $area->{'title_'.app()->getLocale()} }}
                    </h6>
                </div>
            </div>
        @endforeach
    </div>
    {{-- See All di tengah bawah --}}
<div class="text-center mt-3">
    <a href="{{ locale_route('frontend.service') }}" 
       class="fw-light text-primary text-decoration-none">
        {{ __('frontend.see-all') }}
    </a>
</div>

</div>


            </div>

        </div>
    </div>
</section>


<!-- Stats Section -->
<section class="stats-section py-5" style="background: var(--primary-color); color: #fff;">
    <div class="container text-center">

        <!-- Section Title -->
        <div class="mb-5">
            <h2>{{ $homeStat->title }}</h2>
            <p>{{ $homeStat->description }}</p>
        </div>

        <!-- Stats Grid -->
        <div class="row justify-content-center">
            @foreach($stats as $stat)
                <div class="col-6 col-md-3 mb-4">
                    <div class="stat-item text-center">
                        @if($stat->image)
                            <img src="{{ $stat->image_url }}" alt="{{ $stat->label }}"
                                class="mb-3" style="width:50px; height:50px; object-fit:contain;">
                        @endif
                        <h3 class="mb-1">{{ $stat->value }}</h3>
                        <p>{{ $stat->label }}</p>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
</section>


<!-- Team Section -->
<section class="team-section py-5">
    <div class="container text-center">

        <!-- Section Title -->
        <div class="text-primary">
            <h2>{{ $homeTeam->title }}</h2>
        </div>

        <!-- Team Grid -->
        <div class="row justify-content-center">
            @foreach($teams as $team)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="{{ $team->image_url }}" alt="{{ $team->name }}" class="img-fluid">
                            <div class="team-overlay">
                                <h5>{{ $team->name }}</h5>
                                <p>{{ $team->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>






    <!-- News Section -->
<section class="news-section py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">{{ $homeNews->title }}</h2>
            <a href="{{ url('/news') }}" class="text-primary">{{ __('frontend.see-more') }} >></a>
        </div>

        <!-- Swiper Carousel -->
        <div class="swiper news-carousel">
            <div class="swiper-wrapper">
                @foreach($news->take(5) as $item)
                    <div class="swiper-slide">
                        <div class="news-card d-flex">
                            <!-- Image -->
                            <div class="news-image position-relative" style="flex: 1;">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="img-fluid rounded">
                                <div class="gradient-overlay"></div>
                            </div>
                            <!-- Content -->
                            <div class="news-content ps-3" style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                                <small class="news-meta text-muted mb-2">
                                    {{ $item->category->name ?? '' }} | {{ $item->created_at->format('M d, Y') }}
                                </small>
                                <h3 class="news-title mb-2">
                                    {{ Str::limit($item->title, 70) }}
                                </h3>

                                <p class="news-excerpt mb-2">
                                    {!! Str::limit($item->content, 197) !!}
                                </p>
                                <a href="{{ url('/news/' . $item->slug) }}" class="read-more text-primary fw-bold">
                                    {{ __('frontend.read-article') }} >>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>



@endsection
@push('scripts')
<script>
    var swiper = new Swiper('.member-carousel', {
        slidesPerView: 6,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            320: { slidesPerView: 2 },
            576: { slidesPerView: 3 },
            768: { slidesPerView: 4 },
            1024: { slidesPerView: 6 }
        }
    });
    function showTab(tab) {
        document.getElementById('services').style.display = (tab === 'services') ? 'block' : 'none';
        document.getElementById('practice').style.display = (tab === 'practice') ? 'block' : 'none';
    }

    document.addEventListener("DOMContentLoaded", () => showTab('services'));
</script>
@endpush

