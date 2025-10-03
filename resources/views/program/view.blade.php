@extends('layout.main')

@section('meta')
    <title>{{ $program->getTranslated('title') }} | National Park Academy </title>
    <meta name="description" content="{{ Str::limit(strip_tags($program->getTranslated('excerpt')), 160) }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="{{ $program->getTranslated('title') }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($program->getTranslated('excerpt')), 160) }}">
    <meta property="og:image" content="{{ Voyager::image($program->f_image) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $program->getTranslated('title') }}">
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($program->getTranslated('excerpt')), 160) }}">
    <meta name="twitter:image" content="{{ Voyager::image($program->f_image) }}">
@endsection

@section('content')
<section>
    <div class="container max-width-1920">
        <div class="row py-5">
            <div class="col-lg-12">
                <a href="{{ url()->previous() }}" class="float-start program-date text-decoration-none">
    <i class="bi bi-chevron-left"></i> @lang('texts.back')
</a>
                <h4 class="text-center fw-bold program-title">{{ $program->getTranslated('title') }}</h4>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-lg-8">
                <p class="text-start program-date">@lang('texts.last-updated') {{ date('Y/m/d', strtotime($program->created_at)) }}</p>
            </div>
            <div class="col-lg-4">
                <div class="d-flex share-icons float-end">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="share-icon" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $program->getTranslated('title') }}" class="share-icon" target="_blank"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>
        </div>

        <div class="row py-3">
            <div class="col-lg-12">
                {{ $program->getTranslated('excerpt') }}
            </div>

            <div class="col-lg-12 py-3">
                <img src="{{ Voyager::image($program->f_image) }}" class="w-100" alt="">
            </div>

            <div class="col-lg-12 py-5">
                {!! $program->getTranslated('description') !!}
            </div>

            {{-- 🔽 FORM үзүүлэх нөхцөл --}}
<div class="py-5">
@php
    $now = now();
@endphp

@if ($now->lt($program->start_date))
    <div class=" col-lg-4 m-auto  alert alert-warning">⚠️ Бүртгэл хараахан эхлээгүй байна.</div>
@elseif ($now->gt($program->end_date))
    <div class=" col-lg-4 m-auto alert alert-danger">❌ Бүртгэл дууссан байна.</div>
@else
    {{-- Бүртгэлийн хугацаанд байна --}}
    @if ($program->requires_login)
        @auth('customer')
            {{-- Нэвтэрсэн хэрэглэгч форм бөглөнө --}}
            @include('program._form')
        @else
            {{-- Нэвтрэхийг шаардах үед, нэвтрээгүй бол login page рүү үсэрнэ --}}
            <a href="{{ route('customer.signin') }}" class="btn btn-primary">
                @lang('register.register')
            </a>
        @endauth
    @else
        {{-- Нэвтрэх шаардлагагүй, шууд форм харуулна --}}
        @include('program._form')
    @endif
@endif


</div>


        </div>
    </div>
</section>
@endsection
