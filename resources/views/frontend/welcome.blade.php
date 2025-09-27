@extends('layouts.frontend')

@section('content')
<!-- Banner Section -->
<section class="banner-section position-relative" data-aos="fade-up">
    <div class="swiper-container">
        <div class="swiper single-item-carousel">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide position-relative" data-aos="fade-up" data-aos-delay="100">
                        {{-- Gambar banner --}}
                        <img src="{{ asset($slider->image_url) }}" 
                             alt="Banner {{ $loop->iteration }}" 
                             class="w-100">

                        {{-- Overlay putih transparan + gradient --}}
                        <div class="overlay-gradient"></div>

                        {{-- Konten di atas overlay --}}
                        <div class="banner-content position-absolute top-50 start-50 translate-middle text-left px-3" 
                             data-aos="fade-right" data-aos-delay="200">
                            <h1 class="fw-bold mb-3" style="color: #303192; font-size: 4rem;">
                                {{ $slider->{'title_' . app()->getLocale()} }}
                            </h1>
                            <h5 class="mb-3" style="color: #000;">
                                {{ $slider->{'description_' . app()->getLocale()} }}
                            </h5>
                            @if($slider->{'link_caption_' . app()->getLocale()})
                                <a href="{{ $slider->link ?? 'javascript:void(0)' }}" 
                                   class="btn btn-primary rounded-pill" 
                                   data-aos="zoom-in" data-aos-delay="300">
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

<!-- Service & Practice Section -->
<section class="about-page py-5" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <!-- Left Side -->
            <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
                <div class="about-left">
                    <h2 class="text-primary">{{ $homeServiceAndPracticeAreas->title }}</h2>
                    <p style="text-align: justify;">{{ $homeServiceAndPracticeAreas->description }}</p>

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
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
                <!-- Services -->
                <div id="services" class="tab-content">
                    <div class="row g-4">
                        @foreach($services as $service)
                            <div class="col-6 col-md-3 text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <div class="service-item">
                                    @if($service->image)
                                        <img src="{{ asset('assets/images/service/' . $service->image) }}" 
                                             alt="{{ $service->{'title_'.app()->getLocale()} }}" 
                                             class="img-fluid mb-2" style="width:auto; height:70px;">
                                    @endif
                                    <h6 class="fw-bold text-primary">{{ $service->{'title_'.app()->getLocale()} }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ locale_route('frontend.service') }}" class="fw-light text-primary text-decoration-none">
                            {{ __('frontend.see-all') }}
                        </a>
                    </div>
                </div>

                <!-- Practice Areas -->
                <div id="practice" class="tab-content" style="display: none;">
                    <div class="row g-4">
                        @foreach($practiceAreas as $area)
                            <div class="col-6 col-md-3 text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                <div class="practice-item">
                                    @if($area->image)
                                        <img src="{{ asset('assets/images/service/' . $area->image) }}" 
                                             alt="{{ $area->{'title_'.app()->getLocale()} }}" 
                                             class="img-fluid mb-2" style="width:auto; height:70px;">
                                    @endif
                                    <h6 class="fw-bold text-primary">{{ $area->{'title_'.app()->getLocale()} }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ locale_route('frontend.service') }}" class="fw-light text-primary text-decoration-none">
                            {{ __('frontend.see-all') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section py-5" style="background: var(--primary-color); color: #fff;" data-aos="fade-up">
    <div class="container text-center">
        <div class="mb-5">
            <h2 data-aos="fade-up">{{ $homeStat->title }}</h2>
            <p data-aos="fade-up" data-aos-delay="100">{{ $homeStat->description }}</p>
        </div>
        <div class="row justify-content-center">
            @foreach($stats as $stat)
                <div class="col-6 col-md-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="stat-item text-center">
                        @if($stat->image)
                            <img src="{{ $stat->image_url }}" alt="{{ $stat->label }}" class="mb-3" style="width:50px; height:50px; object-fit:contain;">
                        @endif
                        <h3 class="odometer" data-value="{{ $stat->value }}">0</h3>
                        <p>{{ $stat->label }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="team-section py-5" data-aos="fade-up">
    <div class="container text-center">
        <div class="text-primary">
            <h2>{{ $homeTeam->title }}</h2>
        </div>
        <div class="row justify-content-center">
            @foreach($teams as $team)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <a href="{{ locale_route('frontend.about') }}#about-team" class="text-decoration-none text-dark">
                        <div class="team-card">
                            <div class="team-image position-relative">
                                <img src="{{ $team->image_url }}" alt="{{ $team->name }}" class="img-fluid">
                                <div class="team-overlay">
                                    <h5>{{ $team->name }}</h5>
                                    <p>{{ $team->email }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>



<!-- News Section -->
<section class="news-section py-5" data-aos="fade-up">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">{{ $homeNews->title }}</h2>
            <a href="{{ locale_route('frontend.news') }}" class="text-primary">{{ __('frontend.see-more') }} >></a>
        </div>
        <div class="swiper news-carousel">
            <div class="swiper-wrapper">
                @foreach($news->take(5) as $item)
                    <div class="swiper-slide" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="news-card d-flex">
                            <div class="news-image position-relative" style="flex:1;">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="img-fluid rounded">
                                <div class="gradient-overlay"></div>
                            </div>
                            <div class="news-content ps-3" style="flex:1; display:flex; flex-direction:column; justify-content:center;">
                                <small class="news-meta text-muted mb-2">{{ $item->category->name ?? '' }} | {{ $item->created_at->format('M d, Y') }}</small>
                                <h3 class="news-title mb-2">{{ Str::limit($item->title, 70) }}</h3>
                                <p class="news-excerpt mb-2">{!! Str::limit($item->content, 197) !!}</p>
                                <a href="{{ url('/news/' . $item->slug) }}" class="read-more text-primary fw-bold">{{ __('frontend.read-article') }} >></a>
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
function showTab(tab) {
    document.getElementById('services').style.display = (tab === 'services') ? 'block' : 'none';
    document.getElementById('practice').style.display = (tab === 'practice') ? 'block' : 'none';
}
document.addEventListener("DOMContentLoaded", () => showTab('services'));

document.addEventListener('DOMContentLoaded', function() {
    const odometers = document.querySelectorAll('.odometer');

    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if(entry.isIntersecting) {
                const el = entry.target;
                el.innerHTML = el.getAttribute('data-value'); // trigger odometer
                obs.unobserve(el); // stop observing setelah animasi
            }
        });
    }, { threshold: 0.5 }); // setengah elemen terlihat baru trigger

    odometers.forEach(odo => observer.observe(odo));
});


</script>
@endpush
