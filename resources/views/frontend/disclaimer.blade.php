@extends('layouts.frontend')

@section('content')
<section class="py-8 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="text-center mb-5">
                    <!-- Tambahkan margin-top agar tidak terlalu mepet -->
                    <h2 class="fw-bold text-primary mb-4" style="margin-top:2rem;">Disclaimer</h2>

                    <div class="bg-white rounded-3 shadow-sm p-5">
                        <div class="disclaimer-content text-secondary small" style="line-height:1.4; text-align:left;">
                            {!! $disclaimer->{'description_'.app()->getLocale()} ?? '' !!}
                        </div>

                        <hr class="my-4 opacity-25">

                        <div class="d-flex justify-content-center mt-4">
                            <a href="{{ url('/') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-sm">
                                <i class="fas fa-arrow-left me-2"></i>
                                {{ __('frontend.back-to-home') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
