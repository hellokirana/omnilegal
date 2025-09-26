@extends('layouts.frontend')

@section('content')
{{-- Banner Section --}}
<section class="banner-service position-relative" style="margin-top:0px;">
    <div class="position-relative" style="height:350px; overflow:hidden;">
        <img src="{{ asset('assets/images/banner/banner-about.jpg') }}" 
             alt="Banner News" 
             class="w-100 h-100"
             style="object-fit:cover; object-position:center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" 
             style="background: linear-gradient(135deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.6) 100%);"></div>
    </div>
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100">
        <div class="container">
            <h1 class="display-5 fw-light mb-3" 
                style="letter-spacing: -1px; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
               {{ $homeNews->{'title_'.app()->getLocale()} }}
            </h1>
            <p class="fw-light mb-0 text-white" 
               style="font-weight:300; max-width:600px; margin:0 auto; line-height:1.6; 
                      text-shadow:0 1px 2px rgba(0,0,0,0.3);">
                {{ $homeNews->{'description_'.app()->getLocale()} }}
            </p>
        </div>
    </div>
</section>

{{-- News Filter --}}
<section class="news-filter py-5">
    <div class="container text-center">
        <h2 class="mb-4">{{ __('frontend.filter_by_category') }}</h2>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="{{ locale_route('frontend.news') }}" 
               class="btn btn-outline-primary {{ request('category') == '' ? 'active' : '' }}">
               {{ __('frontend.all_categories') }}
            </a>
            @foreach($categories as $category)
                <a href="{{ locale_route('frontend.news', ['category' => $category->id]) }}" 
                   class="btn btn-outline-primary {{ request('category') == $category->id ? 'active' : '' }}">
                    {{ app()->getLocale() == 'id' ? $category->title_id : $category->title_en }}
                </a>
            @endforeach
        </div>
    </div>
</section>


<section class="news-list py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($news as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->title }}">

                        <div class="card-body d-flex flex-column">
                            <small class="text-muted mb-1">
                                {{ $item->category ? $item->category->title : '-' }} |
                                {{ $item->created_at->format('M d, Y') }}
                            </small>

                            <h5 class="card-title mt-2">
    <a href="{{ locale_route('frontend.news-detail', ['slug' => $item->slug]) }}" class="text-dark text-decoration-none">
        {{ Str::limit($item->title, 70) }}
    </a>
</h5>

                            <p class="card-text mt-2 mb-3">
                                {!! Str::limit(strip_tags($item->content), 100) !!}
                            </p>

                            <a href="{{ locale_route('frontend.news-detail', ['slug' => $item->slug]) }}" class="mt-auto text-primary fw-bold">
    {{ __('frontend.read_article') }} >>
</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">{{ __('frontend.no_news_found') }}</p>
                </div>
            @endforelse
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $news->withQueryString()->links() }}
        </div>
    </div>
</section>
@endsection
