@extends('customer.layout.main')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">{{ __('register.welcome', ['name' => $customer->firstname]) }}</h2>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ __('customer.success') }}
            </div>
        @endif
<div class="col-lg-4">


        <div class="card mt-4">
            <div class="card-header text-black fw-bold">{{ __('register.your_info') }}</div>
            <div class="card-body">
                <p><strong>{{ __('customer.firstname') }}:</strong> {{ $customer->firstname }}</p>
                <p><strong>{{ __('customer.lastname') }}:</strong> {{ $customer->lastname }}</p>
                <p><strong>{{ __('register.sex') }}:</strong>
                    {{ $customer->sex == 1 ? __('customer.male') : __('customer.female') }}
                </p>
                <p><strong>{{ __('customer.email') }}:</strong> {{ $customer->email }}</p>
                <p><strong>{{ __('customer.phone') }}:</strong> {{ $customer->phone }}</p>
                <p><strong>{{ __('customer.position') }}:</strong>
                    {{ __('customer.position_'.  $customer->position) }}
                </p>
                <a href="{{ route('customer.edit') }}" class="btn btn-primary">{{ __('customer.edit_info') }}</a>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-8">
        {{-- <div class="card mt-4">
            <div class="card-header text-black fw-bold">{{ __('customer.my_courses') }}</div>
            <div class="card-body">
                @if ($courses->isEmpty())
                    <p>{{ __('customer.no_courses') }}</p>
                @else
                    <ul class="list-group">
                        @foreach ($courses as $course)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('customer.course', ['id' => $course->id]) }}">{{ $course->title }}</a>
                                <span class="badge bg-primary rounded-pill">{{ $course->lessons_count }} {{ __('customer.lessons') }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div> --}}
</div>
@stop
