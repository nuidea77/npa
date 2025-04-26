@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-12" style="background-image: url(assets/img/about-cover.jpg); background-size: cover; background-position: center; height: 650px;">
      </div>
    </div>
</div>
<div class="container">
    <div class="row py-5">
        <div class="col-lg-12">
            <div class="accordion" id="accordionExample">
                @if (isset($faqs))
                @foreach ($faqs as $data)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-{{ $data->id }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $data->id }}" aria-expanded="{{ $data->id }}" aria-controls="collapse-{{ $data->id }}">
                                {{ $data->question }}
                            </button>
                        </h2>
                        <div id="collapse-{{ $data->id }}" class="accordion-collapse collapse-{{ $data->id }} " aria-labelledby="heading-{{ $data->id }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>{{ $data->answer }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
