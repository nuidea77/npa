@extends('customer.layout.main')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-lg-12">

                <div class=" {{ $modalStatus['show'] ? 'lesson-blurred' : '' }}">
                    {{-- Lesson content --}}
                    <div class="lesson-content">

                        <div style="background-image: url({{ Voyager::image($lesson->cover) }}); height:400px; background-repeat:no-repeat; background-size:cover; background-position:center;" ></div>
                        <h1 class="text-center py-3">{{ $lesson->title }}</h1>


                        {{-- Lesson details and content here --}}
                        @if (!$modalStatus['show'])
                            {{-- Video player or lesson content goes here --}}
                            <div class="lesson-media">
                                {{-- Example video embed or content --}}
                                {!! $lesson->body !!}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="lesson-container">
                    {{-- Accessibility Modal --}}
                    @if ($modalStatus)
                        <div id="lesson-access-modal" class="modal fade"  data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                            <a href="{{ url()->previous() }}" class="float-start program-date text-decoration-none">
    <i class="bi bi-chevron-left"></i> @lang('texts.back')
</a>
                                    </div>

                                    <div class="modal-body">

                                       @switch($modalStatus['type'])
    @case('login')
        <h2>@lang('texts.login-required')</h2>
        <p>{{ $modalStatus['message'] }}</p>
        <a href="{{ route('customer.signin') }}" class="btn btn-primary">@lang('texts.login')</a>
        @break

    @case('not_started')
        <h2>@lang('texts.lesson-not-started')</h2>
        <p>{{ $modalStatus['message'] }}</p>
        <p><strong>@lang('texts.start-time'):</strong> {{ $modalStatus['startTime'] }}</p>
        @break

    @case('finished')
        <h2>@lang('texts.lesson-ended')</h2>
        <p>{{ $modalStatus['message'] }}</p>
        <p><strong>@lang('texts.end-time'):</strong> {{ $modalStatus['endTime'] }}</p>
        @break
@endswitch

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Initialize Bootstrap modal if modalStatus['show'] is true
    const modalStatusShow = {{ $modalStatus['show'] ? 'true' : 'false' }};

    if (modalStatusShow) {
        const modal = new bootstrap.Modal(document.getElementById('lesson-access-modal'));
        modal.show(); // Show the modal
    }
});
</script>

