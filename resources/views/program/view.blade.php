@extends('layout.main')
@section('content')
@section('meta')
    <title>{{ $data->getTranslated('title') }} | {{ config('app.name') }}</title>
    <meta name="description" content="{{ Str::limit(strip_tags($data->getTranslated('excerpt')), 160) }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $data->getTranslated('title') }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($data->getTranslated('excerpt')), 160) }}">
    <meta property="og:image" content="{{ Voyager::image($data->f_image) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $data->getTranslated('title') }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($data->getTranslated('excerpt')), 160) }}">
    <meta name="twitter:image" content="{{ Voyager::image($data->f_image) }}">
@endsection
<section>
    <div class="container max-width-1920 ">
        <div class="row  py-5">
            <div class="col-lg-12 ">
                <a href="{{ route('programs.index') }}" class="float-start program-date text-decoration-none">
                    <i class="bi bi-chevron-left"></i> @lang('texts.back')
                </a>
                <h4 class="text-center fw-bold program-title">{{ $data->getTranslated('title') }} </h4>
            </div>
        </div>
        <div class="row py-2">
            <div class="col-lg-8">
               <p class="text-start  program-date">@lang('texts.last-updated') {{ date('Y/m/d', strtotime($data->created_at)) }}</p>
            </div>
            <div class="col-lg-4">
                <div class="d-flex share-icons float-end">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="share-icon" target="_blank">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $data->getTranslated('title') }}" class="share-icon" target="_blank">
                        <i class="bi bi-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-lg-12 ">
            {{ $data->getTranslated('excerpt') }}
            </div>
            <div class="col-lg-12 py-3">
                <img src="{{ Voyager::image($data->f_image) }}" class="w-100" alt="">
            </div>
            <div class="col-lg-12 py-5">
            {!! $data->getTranslated('description') !!}
        </div>
        </div>
    </div>
</section>
@stop
