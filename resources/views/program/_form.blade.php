@php
    use Carbon\Carbon;
    $now = Carbon::now();
    $isBeforeStart = $now->lt($program->start_date);
    $isAfterEnd = $now->gt($program->end_date);
@endphp

<div class="container py-5">


    @if ($isBeforeStart)
        <div class="alert col-lg-4 m-auto alert-warning text-center">
            📅 Бүртгэл {{ $program->start_date->format('Y-m-d') }}-нд эхэлнэ.
        </div>
    @elseif ($isAfterEnd)
        <div class="alert col-lg-4 m-auto alert-danger text-center">
            ❌ Бүртгэл дууссан байна.
        </div>
    @endif

    @if ($program->require_login && !auth('customer')->check())
        <div class="alert col-lg-4 m-auto alert-info text-center">
            🔒 Та бүртгүүлэхийн тулд <a href="{{ route('customer.login') }}">нэвтэрнэ үү</a>.
        </div>
    @elseif (!$isAfterEnd && !$isBeforeStart)
        <form action="{{ route('programs.register', $program->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="program_id" value="{{ $program->id }}">

            <div class="row g-3 py-4">
                @guest('customer')
                    <div class="col-md-3">
                        <label class="form-label">{{ __('register.last_name') }}</label>
                        <input type="text" name="lastname" class="form-control" placeholder="{{ __('register.enter_last_name') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('register.first_name') }}</label>
                        <input type="text" name="firstname" class="form-control" placeholder="{{ __('register.enter_first_name') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('register.sex') }}</label>
                        <select name="sex" class="form-select" required>
                            <option value="">{{ __('register.select_sex') }}</option>
                            <option value="1">{{ __('register.male') }}</option>
                            <option value="2">{{ __('register.female') }}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('register.email') }}</label>
                        <input type="email" name="email" class="form-control" placeholder="{{ __('register.enter_email') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('register.phone') }}</label>
                        <input type="text" name="phone" class="form-control" placeholder="{{ __('register.enter_phone') }}" required>
                    </div>


                <div class="col-md-4">
                    <label class="form-label">{{ __('register.protected_area') }}</label>
                    <select name="hz" class="form-select" required>
                        <option value="">{{ __('register.select_protected_area') }}</option>
                        <option value="tarvagatai_nuru">{{ __('register.tarvagatai_nuru') }}</option>
                        <option value="orkhon_khondii">{{ __('register.orkhon_khondii') }}</option>
                        <option value="munkhkhairkhan">{{ __('register.munkhkhairkhan') }}</option>
                        <option value="ikh_bogd_uul">{{ __('register.ikh_bogd_uul') }}</option>
                        <option value="myangan_ugalzat">{{ __('register.myangan_ugalzat') }}</option>
                        <option value="nomrog">{{ __('register.nomrog') }}</option>
                        <option value="khar_us_nuur">{{ __('register.khar_us_nuur') }}</option>
                        <option value="achit_nuur">{{ __('register.achit_nuur') }}</option>
                        <option value="otgontenger">{{ __('register.otgontenger') }}</option>
                        <option value="bogdkhan_uul">{{ __('register.bogdkhan_uul') }}</option>
                        <option value="ulaan_taiga">{{ __('register.ulaan_taiga') }}</option>
                        <option value="dornod_mongol">{{ __('register.dornod_mongol') }}</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">{{ __('register.position') }}</label>
                    <select name="position" class="form-select" required>
                        <option value="">{{ __('register.select_position') }}</option>
                        <option value="leader">{{ __('register.leader') }}</option>
                        <option value="senior_expert">{{ __('register.senior_expert') }}</option>
                        <option value="expert">{{ __('register.expert') }}</option>
                        <option value="nature_guardian">{{ __('register.nature_guardian') }}</option>
                        <option value="assistant_nature_guardian">{{ __('register.assistant_nature_guardian') }}</option>
                    </select>
                </div>
                 @elseauth('customer')
                    <input type="hidden" name="customer_id" value="{{ auth('customer')->user()->id }}">
                    <input type="hidden" name="lastname" value="{{ auth('customer')->user()->lastname }}">
                    <input type="hidden" name="firstname" value="{{ auth('customer')->user()->firstname }}">
                    <input type="hidden" name="email" value="{{ auth('customer')->user()->email }}">
                    <input type="hidden" name="phone" value="{{ auth('customer')->user()->phone }}">
                    <input type="hidden" name="hz" value="{{ auth('customer')->user()->hz }}">
                    <input type="hidden" name="position" value="{{ auth('customer')->user()->position }}">
                @endguest

                <div class="col-12">
                    <label class="form-label">@lang('texts.answer_optional')</label>
                    <textarea name="answer" class="form-control" placeholder="@lang('texts.answer_hint')" rows="4"></textarea>
                </div>



                <div class="col-12 text-center pt-4">
                    <button type="submit" class="btn btn-primary px-5"
                        @if($isBeforeStart || $isAfterEnd) disabled @endif>
                        {{ __('register.register') }}
                    </button>
                </div>
            </div>
        </form>
    @endif

</div>
