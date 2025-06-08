@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12" style="background-image: url(assets/img/about-cover.jpg); background-size: cover; background-position: center; height: 650px;">
        </div>
      </div>
</div>
<div class="container-fluid max-width-1920 py-5">
    <div class="row pb-3">
        <div class="col-md-12 ">
             <a href="{{ url()->previous() }}" class="float-start program-date text-decoration-none">
    <i class="bi bi-chevron-left"></i> @lang('texts.back')
</a>
            <h4 class="fw-semibold text-uppercase title-section color-primary text-center">@lang('texts.programs')</h4>
        </div>
    </div>
    {{-- <div class="row pb-3 ">
      <div class="col-lg-12">
        <h2 class="fw-semibold  text-uppercase title-section  float-start"> @lang('texts.programs')</h2>
      </div>
    </div> --}}

    <div class="row g-3">
        @if (isset($programs))
        @foreach ($programs as $data)
      <div class="col-lg-3 col-md-6" data-aos="fade-right">
        <div class="card home-card" style="background-image: url({{ Voyager::image($data->f_image) }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
          <div class="overlay"></div>
          <div class="card-img-overlay d-flex flex-column justify-content-end align-items-start" style="background-color: rgba(0, 0, 0, 0.3)">
            <h3 class="card-title fw-bold text-white"> {{ $data->getTranslated('title') }}</h3>
            <p class="card-description text-white">{{ $data->getTranslated('excerpt') }}</p>
            <a href="program/{{ $data->id}}" class="btn btn-hover-animation-switch  card-button fw-semibold text-white p-0 ">
              <span>
              <span class="btn-text">@lang('texts.read-more')</span>
              <span class="btn-icon"> <i class="bi bi-arrow-right"></i></span>
              <span class="btn-icon"><i class="bi bi-arrow-right"></i></span>
            </span>
            </a>
          </div>
        </div>
      </div>
      @endforeach
      @endif
    </div>
    <div class="row pt-3">
        <div class="col-lg-12 ">
        <nav aria-label="Page navigation example" class="float-end">
          {{ $programs->render() }}
        </nav>
      </div>
    </div>
</div>
@stop
