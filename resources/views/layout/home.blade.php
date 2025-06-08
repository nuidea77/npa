<div class="swiper carouselSwiper">
    <div class="swiper-wrapper">
        @if (isset($slider))
        @foreach ($slider as $data)
      <div class="swiper-slide">
        <img src="{{ Voyager::image($data->img) }}" class="img-fluid " alt="">
        <div class="position-absolute bottom-0 start-0 p-3">

          <a href="/places" type="button" class="btn btn-outline-light fw-semibold"> @lang("texts.featured-thg")<i class="bi bi-arrow-right"></i> </a>
        </div>
      </div>
      @endforeach
      @endif
    </div>
    <div class="swiper-pagination"></div>
  </div>
  <div class="container-fluid max-width-1920  py-3 text-white position-relative">
    <div class="row justify-content-center">
      <div class=" col-md-12 col-lg-12 position-relative">
        <div class="bg-primary rounded px-4 py-3 ">
            <form id="placeSearchForm" method="GET" action="{{ route('place.index') }}">
          <div class="row align-items-start">
            <!-- Аймгаар -->
            <div class="col-md-5 mb-3 mb-md-0">
              <label for="provinceSelect" class="form-label fw-bold">@lang('texts.thg-search')</label>
              <div class="input-group">
                <select name="city_id" class="form-select" onchange="this.form.submit()" aria-label="Filter by Province">
                    <option value="" selected disabled hidden >@lang('texts.by-province')</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>

              </div>
            </div>
            <div class="col-md-2" style="justify-items: center;">
              <div class="vr "></div>
              <div>
                <span class="text-uppercase " style="font-size: smaller;">@lang('texts.or')</span>
              </div>
              <div class="vr"></div>
            </div>
            <!-- ТХГ нэрээр -->
            <div class="col-md-5 mb-3 mb-md-0">
              <label for="nameSelect" class="form-label fw-bold">@lang('texts.thg-name')</label>
              <div class="input-group">
                <select name="place_id" class="form-select" onchange="this.form.submit()" aria-label="Filter by Place Name">
                    <option value=""selected disabled hidden>@lang('texts.thg-name')</option>
                    @foreach ($placesOptions as $placeOption)
                        <option value="{{ $placeOption->id }}" {{ request('place_id') == $placeOption->id ? 'selected' : '' }}>
                            {{ $placeOption->title }}
                        </option>
                    @endforeach
                </select>

              </div>
            </div>
          </div>
          <!-- Separator -->
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid max-width-1920  py-5">
    <div class="row pb-3 ">
      <div class="col-12">
        <h2 class="fw-semibold  text-uppercase title-section  float-start"> @lang('texts.programs') </h2>
        <a href="/programs" class="fw-semibold text-uppercase title-button  float-end">@lang('texts.see-more') <i class="bi bi-chevron-right"></i></a>
      </div>

    </div>
    <div class="row  g-3">
        @if (isset($program))
        @foreach ($program as $data)


      <div data-aos="fade-left" class="col-lg-3 col-md-6  ">
        <div class="card home-card" style="background-image: url({{ Voyager::image($data->f_image) }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
          <div class="overlay"></div>
          <div class="card-img-overlay d-flex flex-column justify-content-end align-items-start" style="background-color: rgba(0, 0, 0, 0.3)">
            <h3 class="card-title fw-bold text-white"> {{ $data->title }}</h3>
            <p class="card-description text-white">{{ $data->excerpt }}</p>
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
          {{ $program->render() }}
        </nav>
      </div>
    </div>
  </div>
  <div class="container-fluid max-width-1920 py-5">
    <div class="row pb-3">
      <div class="col-12">
        <h2 class="fw-semibold  text-uppercase title-section  float-start"> @lang('texts.news') </h2>
        <a href="/posts" class="fw-semibold text-uppercase title-button  float-end">@lang('texts.see-more') <i class="bi bi-chevron-right"></i></a>
      </div>

    </div>
    <div class="row  g-3">
        @if (isset($post))
        @foreach ($post as $data)
      <div class="col-lg-3 col-md-6" data-aos="fade-right">
        <div class="card home-card" style="background-image: url({{ Voyager::image($data->image) }}); background-position: center; background-repeat: no-repeat; background-size: cover;">
          <div class="overlay"></div>
          <div class="card-img-overlay d-flex flex-column justify-content-end align-items-start" style="background-color: rgba(0, 0, 0, 0.3)">
            <h3 class="card-title fw-bold text-white"> {{ $data->getTranslated('title') }}</h3>
            <p class="card-description text-white">{{ $data->getTranslated('excerpt') }}</p>
            <a href="/post/{{ $data->id}}" class="btn btn-hover-animation-switch  card-button fw-semibold text-white p-0 ">
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
        {{ $post->render() }}
      </nav>
    </div>
  </div>
  </div>
  <hr>
  <div class="container-fluid  max-width-1920 py-5" data-aos="zoom-in">
    <div class="row">
      <div class="col-lg-4">
        <h1 class="fw-semibold fs-3 text-uppercase"> @lang('texts.submit-comment')</h1>
        <p class="fs-6"> @lang('texts.comment-desc')</p>
      </div>
      <div class="col-lg-8">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
    <label for="type" class="form-label">@lang('texts.type')</label>
    <select name="type" id="type" class="form-select" required>
        <option value="">-- Сонгох --</option>
        <option value="1" @if(old('type') == '1') selected @endif>Санал хүсэлт</option>
        <option value="2" @if(old('type') == '2') selected @endif>Талархал</option>
        <option value="3" @if(old('type') == '3') selected @endif>Гомдол</option>
    </select>
</div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
    <label for="subtitle" class="form-label">@lang('texts.subtitle')</label>
    <select name="subtitle" id="subtitle" class="form-select" required>
        <option value="">-- Сонгох --</option>
        <option value="1" @if(old('subtitle') == '1') selected @endif>Сайн дурын ажил</option>
        <option value="2" @if(old('subtitle') == '2') selected @endif>Ажлын зар</option>
        <option value="3" @if(old('subtitle') == '3') selected @endif>Бусад</option>
    </select>
</div>
                </div>
                <div class="col-lg-6">
                    <label for="email" class="form-label required-field">@lang('texts.email')</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="@lang('texts.email-placeholder')">
                </div>
                <div class="col-lg-6">
                    <label for="phone" class="form-label required-field">@lang('texts.number')</label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="@lang('texts.number-placeholder')">
                </div>
            </div>
            <div class="row py-3">
                <div class="col-lg-12">
                    <label for="message" class="form-label required-field">@lang('texts.comment')</label>
                    <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="@lang('texts.comment-placeholder')"></textarea>
                </div>
                <div class="col-lg-12 align-content-center py-3">
                    <button type="submit" class="btn btn-primary">@lang('texts.submit')</button>
                </div>
            </div>
        </form>

      </div>
    </div>
  </div>

