@php
    $type = $type ?? 'radio';
    $context = $context ?? 'default';
    $currentLocale = app()->getLocale() ?? 'en';
    $segments = request()->segments();

    // pastikan segmen pertama adalah locale
    if (!isset($segments[0]) || !in_array($segments[0], ['id', 'en'])) {
        array_unshift($segments, $currentLocale);
    }

    // default fallback URL
    $segmentsId = $segments;
    $segmentsId[0] = 'id';
    $pathId = implode('/', $segmentsId);
    $urlIdFallback = url($pathId) . (request()->getQueryString() ? '?'.request()->getQueryString() : '');

    $segmentsEn = $segments;
    $segmentsEn[0] = 'en';
    $pathEn = implode('/', $segmentsEn);
    $urlEnFallback = url($pathEn) . (request()->getQueryString() ? '?'.request()->getQueryString() : '');

    // jika sedang di news-detail dan ada $news, pakai slug target locale
    if (request()->routeIs('frontend.news-detail') && isset($news)) {
        $urlId = locale_route('frontend.news-detail', ['locale' => 'id', 'slug' => $news->getSlugByLocale('id')]);
        $urlEn = locale_route('frontend.news-detail', ['locale' => 'en', 'slug' => $news->getSlugByLocale('en')]);
    } else {
        $urlId = $urlIdFallback;
        $urlEn = $urlEnFallback;
    }
@endphp

@if ($type === 'radio' && $context === 'lower')
    <div class="language-switch">
        <input type="radio" name="lang" id="lang-id"
            {{ $currentLocale == 'id' ? 'checked' : '' }}
            onchange="window.location.href='{{ $urlId }}'">
        <label for="lang-id">ID</label>

        <input type="radio" name="lang" id="lang-en"
            {{ $currentLocale == 'en' ? 'checked' : '' }}
            onchange="window.location.href='{{ $urlEn }}'">
        <label for="lang-en">EN</label>

        <span class="switch-highlight"></span>
    </div>
@endif

@if ($type === 'radio' && $context === 'sticky')
    <div class="language-switch">
        <input type="radio" name="lang-sticky" id="lang-id-sticky"
            {{ $currentLocale == 'id' ? 'checked' : '' }}
            onchange="window.location.href='{{ $urlId }}'">
        <label for="lang-id-sticky">ID</label>

        <input type="radio" name="lang-sticky" id="lang-en-sticky"
            {{ $currentLocale == 'en' ? 'checked' : '' }}
            onchange="window.location.href='{{ $urlEn }}'">
        <label for="lang-en-sticky">EN</label>

        <span class="switch-highlight"></span>
    </div>
@endif

@if ($type === 'radio' && $context === 'mobile')
    <div class="language-switch">
        <input type="radio" name="lang-mobile" id="lang-id-mobile"
            {{ $currentLocale == 'id' ? 'checked' : '' }}
            onchange="window.location.href='{{ $urlId }}'">
        <label for="lang-id-mobile">ID</label>

        <input type="radio" name="lang-mobile" id="lang-en-mobile"
            {{ $currentLocale == 'en' ? 'checked' : '' }}
            onchange="window.location.href='{{ $urlEn }}'">
        <label for="lang-en-mobile">EN</label>

        <span class="switch-highlight"></span>
    </div>
@endif