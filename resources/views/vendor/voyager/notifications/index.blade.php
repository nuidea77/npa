@extends('voyager::master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Мэдэгдлүүд</h2>

    <div class="list-group shadow-sm rounded">
        @forelse($notifications as $notification)
            <div class="list-group-item list-group-item-action d-flex flex-column {{ $notification->read_at ? 'bg-white' : 'bg-light' }} rounded mb-2 border">
                <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                    <h6 class="mb-0">{{ $notification->data['title'] ?? 'Мэдэгдэл' }}</h6>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-0 text-muted">{{ $notification->data['message'] ?? '' }}</p>
                <a href="{{ $notification->data['url'] ?? '#' }}"
                   class="mt-2 btn btn-sm btn-outline-primary align-self-start"
                   style="font-size: 0.85rem;">
                    Шийдвэрлэх / Дэлгэрэнгүй
                </a>
            </div>
        @empty
            <div class="p-3 text-center text-muted border rounded">
                Мэдэгдэл алга
            </div>
        @endforelse
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $notifications->links() }}
    </div>
</div>
@endsection

@section('styles')
<style>
    .list-group-item:hover {
        background-color: #f8f9fa !important;
        transition: background-color 0.2s ease-in-out;
    }
    .list-group-item a.btn {
        padding: 0.25rem 0.5rem;
    }
</style>
@endsection
