@extends('layout.main')

@section('content')


<div class="container-fluid  ">
    <div class="row">
        <div class="col-lg-12" style="background-image: url(assets/img/about-cover.jpg); background-size: cover; background-position: center; height: 650px;">
        </div>
      </div>
    <div class="row pb-3">
        <div class="col-md-12 pt-5 ">
             <a href="{{ url()->previous() }}" class="float-start program-date text-decoration-none">
    <i class="bi bi-chevron-left"></i> @lang('texts.back')
</a>
            <h4 class="text-center  text-uppercase fw-semibold">@lang('texts.protected-areas')</h4>
        </div>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="d-flex justify-content-center">
                <form method="GET" action="{{ route('place.index') }}">
                    <div class="d-flex justify-content-end">
                        <!-- Province (City) Filter -->
                        <div class="input-group mx-2">
                            <select name="city_id" class="form-select" onchange="this.form.submit()" aria-label="Filter by Province">
                                <option value="" selected disabled hidden>@lang('texts.by-province')</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Place Name Filter -->
                        <div class="input-group">
                            <select name="place_id" class="form-select" onchange="this.form.submit()" aria-label="Filter by Place Name">
                                <option value="" selected disabled hidden>@lang('texts.thg-name')</option>
                                @foreach ($placesOptions as $placeOption)
                                    <option value="{{ $placeOption->id }}" {{ request('place_id') == $placeOption->id ? 'selected' : '' }}>
                                        {{ $placeOption->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Search Button -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
</div>

<div class="container-fluid max-width-1920 py-4">
    <div class="row pb-5">
        <!-- Check if places exist -->
        @if ($places->isEmpty())
            <div class="col-12">
                <p class="text-center">Хайлтанд тохирох үр дүн олдсонгүй.</p>
            </div>
        @else
            @foreach ($places as $data)
        <div class="col-md-4 col-lg-4 mb-4" data-aos="fade-right">
            <div class="card program-card">
                <img src="{{ Voyager::image($data->f_image) }}" style="height: 350px;" alt="Хөвсгөл нуур">
                <div class="card-body bg-primary">
                    <h5 class="card-title">{{ $data->title }}</h5>
                    <p class="card-text card-description text-white ">{{ $data->hz_info}}</p>
                    <a href="/place/{{ $data->id}}" class="btn btn-hover-animation-switch  card-button fw-semibold text-white p-0 ">
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

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $places->appends(request()->query())->links() }}
    </div>
</div>

@stop
