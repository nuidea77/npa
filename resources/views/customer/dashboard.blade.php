@extends('customer.layout.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">{{ __('register.welcome', ['name' => $customer->firstname]) }}</h2>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ __('customer.success') }}
        </div>
    @endif

    <div class="row justify-content-center mt-4">
        {{-- Хувийн мэдээлэл --}}
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header text-black fw-bold">
                    {{ __('register.your_info') }}
                </div>
                <div class="card-body">
                    <p><strong>{{ __('customer.firstname') }}:</strong> {{ $customer->firstname }}</p>
                    <p><strong>{{ __('customer.lastname') }}:</strong> {{ $customer->lastname }}</p>
                    <p><strong>{{ __('register.sex') }}:</strong>
                        {{ $customer->sex == 1 ? __('customer.male') : __('customer.female') }}
                    </p>
                    <p><strong>{{ __('customer.email') }}:</strong> {{ $customer->email }}</p>
                    <p><strong>{{ __('customer.phone') }}:</strong> {{ $customer->phone }}</p>
                    <p><strong>{{ __('customer.position') }}:</strong>
                        {{ __('customer.position_' . $customer->position) }}
                    </p>
                    <a href="{{ route('customer.edit') }}" class="btn btn-primary mt-3">
                        {{ __('customer.edit_info') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Тамганы түүх --}}
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header text-black fw-bold">
                    {{ __('customer.stamp_history') }}
                </div>
                <div class="card-body">
                    @if ($stampHistory && $stampHistory->count() > 0)
                        <ul class="list-group">
                            @foreach ($stampHistory as $history)
                                <li class="list-group-item d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $history->stamp->icon) }}"
                                         alt="{{ $history->stamp->name }}"
                                         style="max-width: 70px; height: auto; margin-right: 15px;">
                                    <div>
                                        <p class="mb-1"><strong>{{ __('customer.stamp_name') }}:</strong> {{ $history->stamp->name }}</p>
                                        <p class="mb-0"><strong>{{ __('customer.stamp_date') }}:</strong> {{ $history->stamp->created_at->format('Y-m') }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ __('customer.no_stamp_history') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100 ">
                <div class="card-header text-black fw-bold">
                    {{ __('customer.form_title') }}
                </div>
                <div class="card-body">
                    <p>{{ __('customer.form_desc') }}</p>
                    <a href=" " class="btn btn-primary">
                        {{ __('customer.form_button') }}
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-lg-12 mb-4">
            <div class="card h-100">
                <div class="card-header text-black fw-bold">
                    {{ __('customer.lesson_list') }}
                </div>
                <div class="card-body">

    @if($lessons->count() > 0)
        <div class="list-group">
            @foreach($lessons as $lesson)
                <a href="{{ route('customer.lesson.view', $lesson->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <h5 class="mb-1">{{ $lesson->title }}</h5>
                        <small>
                            @if ($lesson->started_at)
                                {{ __('customer.started_date') }}: {{ \Carbon\Carbon::parse($lesson->started_at)->format('Y-m-d') }}
                            @endif
                        </small>
                    </div>
                    <p class="mb-1 text-truncate" style="max-width: 600px;">{!! strip_tags(Str::limit($lesson->body, 100)) !!}</p>
                </a>
            @endforeach
        </div>
    @else
        <p>{{ __('customer.no_lesson') }}</p>
    @endif

</div>
@endsection
