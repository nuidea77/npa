@extends('customer.layout.main')

@section('content')
    <div class="container mt-5">
          <div class="row py-5">
            <div class="col-lg-12">
               <a href="{{ url()->previous() }}" class="float-start program-date text-decoration-none">
    <i class="bi bi-chevron-left"></i> @lang('texts.back')
</a>
                <h1 class="text-center fw-bold program-title">@lang('customer.edit_info')</h1>
            </div>
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customer.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="avatar" class="form-label">@lang('customer.upload_avatar')</label>
                @if ($customer->avatar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $customer->avatar) }}" alt="@lang('customer.current_avatar')" class="rounded-circle" width="80" height="80">
                    </div>
                @endif
                <input type="file" name="avatar" id="avatar" class="form-control">
                <small class="text-muted">@lang('customer.keep_avatar')</small>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">@lang('customer.firstname')</label>
                <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $customer->firstname }}" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">@lang('customer.lastname')</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $customer->lastname }}" required>
            </div>
            <div class="mb-3">
                <label for="sex" class="form-label">@lang('customer.gender')</label>
                <select name="sex" id="sex" class="form-select" required>
                    <option value="1" {{ $customer->sex === 'male' ? 'selected' : '' }}>@lang('customer.male')</option>
                    <option value="2" {{ $customer->sex === 'female' ? 'selected' : '' }}>@lang('customer.female')</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">@lang('customer.email')</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $customer->email }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">@lang('customer.phone')</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $customer->phone }}" required>
            </div>
            <div class="mb-3">
                <label for="hz" class="form-label">@lang('register.protected_area')</label>
                <select name="hz" id="hz" class="form-select" required>
                    <option value="" disabled selected>@lang('register.select_protected_area')</option>
                    <option value="1" {{ $customer->hz == 1 ? 'selected' : '' }}>@lang('register.tarvagatai_nuru')</option>
                    <option value="2" {{ $customer->hz == 2 ? 'selected' : '' }}>@lang('register.orkhon_khondii')</option>
                    <option value="3" {{ $customer->hz == 3 ? 'selected' : '' }}>@lang('register.munkhkhairkhan')</option>
                    <option value="4" {{ $customer->hz == 4 ? 'selected' : '' }}>@lang('register.ikh_bogd_uul')</option>
                    <option value="5" {{ $customer->hz == 5 ? 'selected' : '' }}>@lang('register.myangan_ugalzat')</option>
                    <option value="6" {{ $customer->hz == 6 ? 'selected' : '' }}>@lang('register.nomrog')</option>
                    <option value="7" {{ $customer->hz == 7 ? 'selected' : '' }}>@lang('register.khar_us_nuur')</option>
                    <option value="8" {{ $customer->hz == 8 ? 'selected' : '' }}>@lang('register.achit_nuur')</option>
                    <option value="9" {{ $customer->hz == 9 ? 'selected' : '' }}>@lang('register.otgontenger')</option>
                    <option value="10" {{ $customer->hz == 10 ? 'selected' : '' }}>@lang('register.bogdkhan_uul')</option>
                    <option value="11" {{ $customer->hz == 11 ? 'selected' : '' }}>@lang('register.ulaan_taiga')</option>
                    <option value="12" {{ $customer->hz == 12 ? 'selected' : '' }}>@lang('register.dornod_mongol')</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">@lang('register.position')</label>
                <select name="position" id="position" class="form-select" required>
                    <option value="1" {{ $customer->position == 1 ? 'selected' : '' }}>@lang('customer.position_1')</option>
                    <option value="2" {{ $customer->position == 2 ? 'selected' : '' }}>@lang('customer.position_2')</option>
                    <option value="3" {{ $customer->position == 3 ? 'selected' : '' }}>@lang('customer.position_3')</option>
                    <option value="4" {{ $customer->position == 4 ? 'selected' : '' }}>@lang('customer.position_4')</option>
                    <option value="5" {{ $customer->position == 5 ? 'selected' : '' }}>@lang('customer.position_5')</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">@lang('customer.new_password')</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">@lang('customer.confirm_password')</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">@lang('customer.update_info')</button>
            <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">@lang('customer.cancel')</a>
        </form>
    </div>
@endsection
