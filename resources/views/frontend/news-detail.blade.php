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

        <p class="text-muted mb-4">
            {{-- Category dengan locale --}}
            {{ $news->category ? (app()->getLocale() == 'id' ? $news->category->title_id : $news->category->title_en) : '-' }} |
            {{ $news->created_at->format('d M Y') }}
        </p>

        @if($news->image)
            <div class="mb-4">
                <img src="{{ $news->image_url }}" alt="{{ $news->{'title_' . app()->getLocale()} }}" class="img-fluid rounded">
            </div>
        @endif

        <div class="news-content mb-4">
            {{-- Content dengan locale --}}
            {!! $news->{'content_' . app()->getLocale()} !!}
        </div>

        {{-- Document dengan locale --}}
        @php
            $documentUrl = app()->getLocale() == 'id' ? $news->document_id_url : $news->document_en_url;
        @endphp
        @if($documentUrl)
            <div class="mb-4">
                <a href="{{ $documentUrl }}" target="_blank" class="btn btn-primary">
                    <i class="fas fa-file-download me-1"></i> {{ __('frontend.download_document') }}
                </a>
            </div>
        @endif

        <div class="mt-4">
            <a href="{{ locale_route('frontend.news') }}" class="btn btn-outline-secondary">
                &laquo; {{ __('frontend.back_to_news') }}
            </a>
        </div>
    </div>
</section>
@endsection