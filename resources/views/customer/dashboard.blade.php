@extends('customer.layout.main')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">{{ __('register.welcome', ['name' => $customer->firstname]) }}</h2>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center mt-4">
        {{-- Хувийн мэдээлэл --}}
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header  fw-bold">
                    <i class="bi bi-person-circle me-2"></i>{{ __('register.your_info') }}
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <strong>{{ __('customer.firstname') }}:</strong> {{ $customer->firstname }}
                    </div>
                    <div class="mb-2">
                        <strong>{{ __('customer.lastname') }}:</strong> {{ $customer->lastname }}
                    </div>
                    <div class="mb-2">
                        <strong>{{ __('register.sex') }}:</strong>
                        {{ $customer->sex == 1 ? __('customer.male') : __('customer.female') }}
                    </div>
                    <div class="mb-2">
                        <strong>{{ __('customer.email') }}:</strong> {{ $customer->email }}
                    </div>
                    <div class="mb-2">
                        <strong>{{ __('customer.phone') }}:</strong> {{ $customer->phone }}
                    </div>
                    <div class="mb-2">
                        <strong>{{ __('customer.position') }}:</strong>
                        {{ $customer->positionLabel }}
                    </div>
                    <div class="mb-2">
                        <strong>{{ __('customer.protected_area') }}:</strong>
                        {{ $customer->protectedArea->name ?? 'N/A' }}
                    </div>
                    <a href="{{ route('customer.edit') }}" class="btn btn-primary mt-3 w-100">
                        <i class="bi bi-pencil me-2"></i>{{ __('customer.edit_info') }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Тамганы түүх --}}
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header  fw-bold">
                    <i class="bi bi-trophy me-2"></i>{{ __('customer.stamp_history') }}
                </div>
                <div class="card-body">
                    @if ($stampHistories && $stampHistories->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach ($stampHistories as $history)
                                <li class="list-group-item d-flex align-items-center px-0">
                                    @if($history->stamp->image)
                                        <img src="{{ asset('storage/' . $history->stamp->image) }}"
                                             alt="{{ $history->stamp->name }}"
                                             class="rounded"
                                             style="max-width: 60px; height: 60px; object-fit: cover; margin-right: 15px;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center me-3"
                                             style="width: 60px; height: 60px;">
                                            <i class="bi bi-trophy text-muted" style="font-size: 2rem;"></i>
                                        </div>
                                    @endif

                                    <div class="flex-grow-1">
                                        <p class="mb-1 fw-semibold">{{ $history->stamp->name }}</p>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ $history->assigned_date ? $history->assigned_date->format('Y-m-d') : 'N/A' }}
                                        </small>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">{{ __('customer.no_stamp_history') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Санал хүсэлт --}}
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header  fw-bold">
                    <i class="bi bi-chat-left-text me-2"></i>{{ __('customer.form_title') }}
                </div>
                <div class="card-body d-flex flex-column">
                    <p class="flex-grow-1">{{ __('customer.form_desc') }}</p>
                    <a href="{{ route('customer.feedback') }}" class="btn btn-info text-white w-100">
                        <i class="bi bi-send me-2"></i>{{ __('customer.form_button') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Хичээлийн жагсаалт --}}
    <div class="row justify-content-center mt-4">
        <div class="col-lg-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header text-dark fw-bold">
                    <i class="bi bi-book me-2"></i>{{ __('customer.lesson_list') }}
                </div>
                <div class="card-body">
                    @if($lessons && $lessons->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($lessons as $lesson)
                                <a href="{{ route('customer.lesson.view', $lesson->id) }}"
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <h5 class="mb-1">
                                            <i class="bi bi-journal-text text-primary me-2"></i>
                                            {{ $lesson->title }}
                                        </h5>
                                        <small class="text-muted">
                                            @if ($lesson->started_at)
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ \Carbon\Carbon::parse($lesson->started_at)->format('Y-m-d') }}
                                            @endif
                                        </small>
                                    </div>
                                    <p class="mb-1 text-muted text-truncate" style="max-width: 100%;">
                                        {!! strip_tags(Str::limit($lesson->body, 150)) !!}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">{{ __('customer.no_lesson') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
