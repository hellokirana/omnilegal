@extends('layouts.frontend')

@section('content')
    <!-- banner-section -->
    {{-- <section class="banner-section-one ">
        <div class="bg-layer" style="background-image: url({{ asset('assets/images/banner/banner-1-bg.jpg') }});">
        </div>
        <div class="container">
            <div class="swiper-container">
                <div class="swiper single-item-carousel">
                    <div class="swiper-wrapper">
                        @forelse($sliders as $slider)
                            <div class="swiper-slide testimonial-slider-item">
                                <a href="{{ $slider->link }}" target="_blank">
                                    <img src="{{ $slider->image_url }}" class="w-100">
                                </a>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="banner-section">
    <div class="swiper-container">
        <div class="swiper single-item-carousel">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="https://picsum.photos/1920/1080?random=1" alt="Banner 1">
                </div>
                <div class="swiper-slide">
                    <img src="https://picsum.photos/1920/1080?random=2" alt="Banner 2">
                </div>
                <div class="swiper-slide">
                    <img src="https://picsum.photos/1920/1080?random=3" alt="Banner 3">
                </div>
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
                        {{ $homeServiceAndPracticeAreas->title_id ?? $homeServiceAndPracticeAreas->title_en }}
                    </h2>
                    <p style="text-align: justify;">
                        {{ $homeServiceAndPracticeAreas->description_id ?? $homeServiceAndPracticeAreas->description_en }}
                    </p>

                    <!-- Switch Services/Practice -->
                    <div class="service-practice-switch mt-3">
                        <div class="sp-switch">
                            <input type="radio" id="switch-services" name="switch-tab" checked>
                            <label for="switch-services" onclick="showTab('services')">Services</label>

                            <input type="radio" id="switch-practice" name="switch-tab">
                            <label for="switch-practice" onclick="showTab('practice')">Practice Areas</label>

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
                                    <img src="{{ $service->image }}" alt="{{ $service->title_id }}" class="img-fluid mb-2">
                                    <h6>{{ $service->title_id ?? $service->title_en }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ url('/services') }}" class="btn-1">See All <i class="icon-arrow-1"></i></a>
                    </div>
                </div>

                <!-- Practice Areas -->
                <div id="practice" class="tab-content" style="display: none;">
                    <div class="row g-4">
                        @foreach($practiceAreas as $area)
                            <div class="col-6 col-md-3 text-center">
                                <div class="practice-item">
                                    <img src="{{ $area->image }}" alt="{{ $area->title_id }}" class="img-fluid mb-2">
                                    <h6>{{ $area->title_id ?? $area->title_en }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ url('/practice-areas') }}" class="btn-1">See All <i class="icon-arrow-1"></i></a>
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
            <h2>{{ $homeStat->title_id ?? $homeStat->title_en }}</h2>
            <p>{{ $homeStat->description_id ?? $homeStat->description_en }}</p>
        </div>

        <!-- Stats Grid -->
        <div class="row justify-content-center">
            @foreach($stats as $stat)
                <div class="col-6 col-md-3 mb-4">
                    <div class="stat-item">
                        @if($stat->image)
                            <img src="{{ $stat->image }}" alt="{{ $stat->label_id }}" class="mb-3" style="width:50px; height:50px; object-fit:contain;">
                        @endif
                        <h3 class="mb-1">{{ $stat->value }}</h3>
                        <p>{{ $stat->label_id ?? $stat->label_en }}</p>
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
        <div class="mb-5">
            <h2>{{ $homeTeam->title_id ?? $homeTeam->title_en }}</h2>
        </div>

        <!-- Team Grid -->
        <div class="row justify-content-center">
            @foreach($teams as $team)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="team-card">
                        <div class="team-image">
                            <img src="{{ $team->image }}" alt="{{ $team->name }}">
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





    <!-- featured -->
    <section class="featured">
        <div class="container">
            <div class="common-title">
                <h6>SHOWING</h6>
                <h3>Recent Media & News</h3>
            </div>
            <div class="row g-4">
                @forelse($news as $media)
                    <div class="col-lg-4 col-md-6">
                        <div class="featured-single">
                            <div class="featured-single-image">
                                <a href="{{ url('media/' . $media->slug) }}">
                                    <div style="width: 100%; aspect-ratio: 16 / 9; overflow: hidden; border-radius: 8px;">
                                        <img src="{{ $media->image_url }}" alt="{{ $media->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                                    </div>
                                </a>
                            </div>
                            <div class="featured-single-wishlist">
                                <h6>{{ @$media->kategori->title}}</h6>
                            </div>
                            <div class="featured-single-content">

                                <a href="{{ route('media.detail', $media->slug) }}">{{ $media->title }}</a>
                                <div class="featured-single-info">
                                    <a href="{{ route('media.detail', $media->slug) }}">Lihat selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
    <!-- featured -->  

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

