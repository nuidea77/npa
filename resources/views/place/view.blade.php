@extends('layout.main')
@section('content')
@section('meta')
    <title>{{ $data->getTranslated('title') }} | National Park Academy </title>
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
<div class="max-width-1920">


<div class="container  py-5 pe-5">
    <div class="row">
        <div class="col-md-12 ">
            <a href="{{ url()->previous() }}" class="float-start program-date text-decoration-none">
                <i class="bi bi-chevron-left"></i> @lang('texts.back')
            </a>
            <h4 class="fw-semibold color-primary text-center">{{ $data->title }}</h4>
        </div>
    </div>
    <div class="row py-4">
        <div class="col-lg-8">
            <p class="text-start program-date">@lang('texts.last-updated') {{ date('Y/m/d', strtotime($data->created_at)) }}</p>
        </div>
        <div class="col-lg-4">
            <div class="d-flex share-icons float-end">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="share-icon" target="_blank">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $data->getTranslated('title') }}" class="share-icon" target="_blank">
                    <i class="bi bi-twitter-x"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
        <div class="swiper placeSwiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img src="{{ Voyager::image($data->f_image) }}" class="img-fluid" alt="">
              </div>


              @php
              // Decode the images JSON field into an array
              $images = json_decode($data->images, true) ?? [];
          @endphp



                  @foreach ($images as $image)
                      <div class="swiper-slide">
                          <img src="{{ Voyager::image($image) }}" class="img-fluid" alt="Image">
                      </div>
                  @endforeach

            </div>
            <div class="swiper-pagination"></div>
        </div>
        </div>
    </div>

    <div class="row py-4 g-3 ">
        <div class="col-md-4 col-sm-6 p-info">
            <h6 class="text-start p-info-title fw-semibold">Харъяалагдах аймаг</h6>
            <p class="text-start p-info-desc program-date">{{ $data->city->name }}</p>
        </div>

        <div class="col-md-4 col-sm-6 d-inline-flex  p-info">
          <div class="vr me-2 p-0 float-start"></div>
          <div class="p-info  ">
            <h6 class="text-start p-info-title fw-semibold">Төрөл</h6>
            <p class="text-start  p-info-desc program-date">{{ $data->type }}</p>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 d-inline-flex  p-info">
          <div class="vr me-2 p-0 float-start"></div>
          <div class="p-info  ">
            <h6 class="text-start p-info-title fw-semibold">ТХГ-ын нэр</h6>
            <p class="text-start  p-info-desc program-date">{{ $data->name }}</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 d-inline-flex  justify-content-between p-info">

            <h6 class="text-start p-info-title fw-semibold">ХЗ-ны лого</h6>
            <img src="{{ Voyager::image($data->hz_logo) }}" class="float-end" alt="">

        </div>
        <div class="col-md-4 col-sm-6 d-inline-flex  p-info">
          <div class="vr me-2 p-0 float-start"></div>
          <div class="p-info  ">
            <h6 class="text-start p-info-title fw-semibold">Хамгаалалтын захиргааны нэр</h6>
            <p class="text-start  p-info-desc program-date">{{ $data->hz_name }}</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 d-inline-flex  p-info">
          <div class="vr me-2 p-0 float-start"></div>
          <div class="p-info  ">
            <h6 class="text-start p-info-title fw-semibold">ХЗ-ны утас, и-мэйл</h6>
            <p class="text-start  p-info-desc program-date">{{ $data->hz_contact }}</p>
          </div>
        </div>

  </div>

    <hr>
    <div class="row py-4">
        <div class="col-lg-12">
            <div class="accordion" id="accordionExample">
                @php
                    $accordionItems = [
                        ['title' => 'ХЗ-ны товч танилцуулга', 'content' => $data->hz_info],
                        ['title' => 'Онцолж буй байгалийн тогтоц газар', 'content' => $data->hz_place],
                        ['title' => 'Амьтад', 'content' => $data->animal],
                        ['title' => 'Газар зүйн онцлог', 'content' => $data->geography],
                        ['title' => 'Нутгийн зон олон', 'content' => $data->nutgiin],
                        ['title' => 'Хэрхэн хүрч очих вэ?', 'content' => $data->hureh],
                        ['title' => 'Хэрхэн аялах вэ?', 'content' => $data->aylah],
                        ['title' => 'Аялал жуулчлалын үйлчилгээ', 'content' => $data->service],
                        ['title' => 'Анхааруулга, уриалга', 'content' => $data->attention],
                        ['title' => 'Хамгаалалтын захиргаа', 'content' => $data->zahirgaa],
                        ['title' => 'Газрын зураг дээр харах', 'content' => $data->map],
                    ];
                @endphp
                @foreach ($accordionItems as $index => $item)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-{{ $index }}">
                            <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse-{{ $index }}">
                                {{ $item['title'] }}
                            </button>
                        </h2>
                        <div id="collapse-{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $index }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>{{ $item['content'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>

<hr>
<div class="container-fluid max-width-1920 py-5" data-aos="zoom-in">
    <div class="row">
      <div class="col-lg-4">
        <h1 class="fw-semibold fs-3 text-uppercase"> @lang('texts.submit-comment')</h1>
        <p class="fs-6"> @lang('texts.comment-desc')</p>
      </div>
      <div class="col-lg-8">
        <form action="" >
          <div class="row">
            <div class="col-lg-6 ">
              <label for="email"  class="form-label required-field">@lang('texts.email')</label>
              <input type="email"  class="form-control" id="email" required placeholder="@lang('texts.email-placeholder')" >
            </div>
            <div class="col-lg-6">
              <label for="phone" class="form-label required-field">@lang('texts.number')</label>
              <input type="phone" class="form-control" id="phone" placeholder="@lang('texts.number-placeholder')">
            </div>
          </div>
          <div class="row py-3">
            <div class="col-lg-12">
              <label for="message" class="form-label required-field">@lang('texts.comment')</label>
              <textarea class="form-control"  id="message" rows="4" placeholder="@lang('texts.comment-placeholder')"></textarea>
            </div>
            <div class="col-lg-12 align-content-center py-3">
              <button type="submit " class="btn btn-primary">@lang('texts.submit')</button>
            </div>

          </div>


        </form>

      </div>
    </div>
  </div>

@stop
