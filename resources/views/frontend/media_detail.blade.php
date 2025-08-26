@extends('layouts.frontend')

@section('content')
    <section class="common-banner">
        <div class="bg-layer" style="background: url('{{ asset('assets/images/background/common-banner-bg.jpg') }}');"></div>
        <div class="common-banner-content">
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item active"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item active"><i class="fa-solid fa-angles-right"></i><a href="{{ url('media/') }}">Media</a></li>
                    @if(isset($data))
                        <li class="breadcrumb-item"><i class="fa-solid fa-angles-right"></i>{{ $data->title }}</li>
                    @endif
                </ul>
            </div>
        </div>
    </section>

    <section class="service-details">
        <div class="container">
            <div class="row">
                <!-- Konten Utama -->
                <div class="col-lg-6">
                    <div class="common-title">
                        <h2>{{ $data->title }}</h2>
                        @if($data->penulis)
                            <div style="font-size: 0.9rem; color: #888; text-align: left; margin-top: 4px;">
                                Editor: {{ $data->penulis }}
                            </div>
                        @endif
                    </div>

                    @if($data->created_at)
                        <div style="text-align: right; font-size: 0.85rem; color: #888; margin-bottom: 0.5rem;">
                            {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') }}
                        </div>
                    @endif

                    <div class="ratio ratio-16x9 mb-2"
                        style="background-image: url('{{ $data->image_url }}'); background-repeat: no-repeat; background-size: cover;">
                    </div>

                    @if($data->caption)
                        <div style="text-align: center; font-size: 0.85rem; color: #888; margin-bottom: 1rem;">
                            {{ $data->caption }}
                        </div>
                    @endif

                    <div class="service-details-content">
                        {!! $data->konten !!}
                    </div>
                </div>

                <div class="col-lg-4 ms-auto">
    <h5 class="mb-3">Featured Articles</h5>
    @foreach($featuredArticles as $item)
        <div class="card mb-3 shadow-sm border-0">
            <div class="row g-0 align-items-center">
                <div class="col-4" style="max-width: 80px; height: 80px; overflow: hidden;">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                         style="width: 80px; height: 80px; object-fit: cover; display: block;">
                </div>
                <div class="col-8">
                    <div class="card-body py-2 px-3">
                        <a href="{{ url('media/' . $item->slug) }}" style="text-decoration: none;">
                            <h6 class="card-title mb-0 text-danger"
                                style="
                                    font-size: 0.95rem;
                                    white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                ">
                                {{ $item->title }}
                            </h6>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


            </div>
        </div>
    </section>
@endsection
