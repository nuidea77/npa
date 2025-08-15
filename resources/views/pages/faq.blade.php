@extends('layout.main')
@section('content')
<div class="container-fluid">

</div>
<div class="container">
    <div class="row py-5">
        <div class="col-lg-12">
              <div class="row pb-5">
        <div class="col-md-12 pt-5 ">
             <a href="{{ url()->previous() }}" class="float-start program-date text-decoration-none">
    <i class="bi bi-chevron-left"></i> @lang('texts.back')
</a>
            <h4 class="text-center  text-uppercase fw-semibold">@lang('texts.faq')</h4>
        </div>
    </div>
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
