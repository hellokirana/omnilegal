@extends('layouts.frontend')

@section('content')
    <!-- banner-section -->
    <section class="banner-section-one ">
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
    </section>

    <!-- about page -->
    <section class="about-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="about-page-left">
                        <div class="pink-shape"></div>
                        <div class="about-page-left-image">
                            <img src="{{ asset('assets/images/resource/rotokemas.png') }}" alt="image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="rewards-left-container">
                        <div class="rewards-left-container-inner">
                            <div class="common-title mb_30">
                                <h6><i class="fa-solid fa-angles-right"></i> SHOWING </h6>
                                <h3>About Rotokemas Indonesia</h3>
                                <p style="text-align: justify;">The Packaging Industry Association - Rotokemas is an organization established to support the development of the packaging industry in Indonesia, focusing on innovation, standardization, and collaboration among industry players. Rotokemas has served as a platform for packaging companies to share knowledge, enhance production quality, and expand business networks.</p>
                            </div>
                            {{-- <div class="rewards-left-list">
                                <ul>
                                    <li><i class="fa-sharp fa-light fa-circle-check"></i>Mitra Profesional & Berpengalaman</li>
                                    <li><i class="fa-sharp fa-light fa-circle-check"></i>Akses Gratis ke Ribuan Peluang Kerja</li>
                                    <li><i class="fa-sharp fa-light fa-circle-check"></i>Dukung Pertumbuhan Bisnis & Basis Klien</li>
                                    <li><i class="fa-sharp fa-light fa-circle-check"></i>Penghasilan Tambahan dengan Jadwal Fleksibel</li>
                                    <li><i class="fa-sharp fa-light fa-circle-check"></i>Mitra Profesional & Berpengalama</li>
                                </ul>
                            </div> --}}
                            <div class="reward-btn">
                                <a href="{{ url('/tentang') }}" class="btn-1">See More <i class="icon-arrow-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
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
</script>
@endpush

