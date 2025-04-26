@extends('layout.main')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-lg-12">

                <div class="{{ $modalStatus['show'] ? 'lesson-blurred' : '' }}">
                    {{-- Lesson content --}}
                    <div class="lesson-content">
                        <h1>{{ $lesson->title }}</h1>
                        <img src="{{ Voyager::image($lesson->cover) }}" alt="">


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

                                    <div class="modal-body">
                                        @switch($modalStatus['type'])
                                            @case('login')
                                                <h2>Нэвтрэх шаардлага</h2>
                                                <p>{{ $modalStatus['message'] }}</p>
                                                <a href="{{ route('customer.signin') }}" class="btn btn-primary">Нэвтрэх</a>
                                            @break

                                            @case('not_started')
                                                <h2>Хичээл эхлээгүй</h2>
                                                <p>{{ $modalStatus['message'] }}</p>
                                                <p>Эхлэх хугацаа: {{ $modalStatus['startTime'] }}</p>
                                            @break

                                            @case('finished')
                                                <h2>Хичээл дууссан</h2>
                                                <p>{{ $modalStatus['message'] }}</p>
                                                <p>Дуусах хугацаа: {{ $modalStatus['endTime'] }}</p>
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
