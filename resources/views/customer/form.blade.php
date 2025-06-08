 @extends('customer.layout.main')

@section('content')
 <div class="container max-width-1920 py-5" data-aos="zoom-in">
    <div class="row py-5">
            <div class="col-lg-12">
               <a href="{{ url()->previous() }}" class="float-start text-black program-date text-decoration-none">
    <i class="bi bi-chevron-left"></i> @lang('texts.back')
</a>
                <h1 class="text-center fw-bold program-title">@lang('texts.submit-comment')</h1>
            </div>
        </div>
    <div class="row">

      <div class="col-lg-12">
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
@endsection
