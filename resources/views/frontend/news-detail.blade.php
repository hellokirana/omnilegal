@extends('layouts.frontend')

@section('content')
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                @foreach($breadcrumbs as $breadcrumb)
                    @if($loop->last)
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
</section>

<section class="news-detail py-5">
    <div class="container">
        {{-- Title menggunakan accessor atau langsung dengan locale --}}
        <h1 class="mb-3">{{ $news->{'title_' . app()->getLocale()} }}</h1>

        <p class="text-muted mb-1">
            {{-- Category dengan locale --}}
            {{ $news->category ? (app()->getLocale() == 'id' ? $news->category->title_id : $news->category->title_en) : '-' }} |
            {{ $news->created_at->format('d M Y') }}
        </p>
        <p class="text-muted mb-4">
            {{ __('frontend.author') }} 
            {{ $news->author}}
        </p>

        @if($news->image)
            <div class="mb-4">
                <img src="{{ $news->image_url }}" alt="{{ $news->{'title_' . app()->getLocale()} }}" class="img-fluid rounded">
            </div>
        @endif

        <div class="news-content mb-4">
    @php
        $locale = app()->getLocale();
        $fullContent = $news->{'content_' . $locale};
        $limit = 1500; // karakter sebelum Read More
    @endphp

    @if(strlen(strip_tags($fullContent)) > $limit)
        <div class="content-wrapper" style="max-height: 300px; overflow: hidden; position: relative;">
            {!! $fullContent !!}
            <div class="fade-overlay" style="position:absolute; bottom:0; left:0; right:0; height:60px; background: linear-gradient(transparent, white);"></div>
        </div>
        <a href="javascript:void(0)" class="read-more-link text-primary fw-bold mt-2 d-block">{{ __('frontend.read-more') }}</a>
    @else
        {!! $fullContent !!}
    @endif
</div>

        {{-- Document dengan locale --}}
        @php
            $documentUrl = app()->getLocale() == 'id' ? $news->document_id_url : $news->document_en_url;
        @endphp
        @if($documentUrl)
            <div class="mb-1">
                <a href="{{ $documentUrl }}" target="_blank" class="btn btn-primary rounded-pill">
                    <i class="fas fa-file-download me-1"></i> {{ __('frontend.download_document') }}
                </a>
            </div>
        @endif

        <div class="mt-1">
            <a href="{{ locale_route('frontend.news') }}" class="btn btn-outline-secondary rounded-pill">
                &laquo; {{ __('frontend.back_to_news') }}
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const readMoreLink = document.querySelector('.read-more-link');
        if(readMoreLink){
            readMoreLink.addEventListener('click', function() {
                const wrapper = document.querySelector('.content-wrapper');
                wrapper.style.maxHeight = 'none'; // buka semua
                const overlay = wrapper.querySelector('.fade-overlay');
                overlay.remove(); // hapus fade
                readMoreLink.remove(); // hapus link read more
            });
        }
    });
</script>
@endpush