@extends('voyager::master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Stamp Histories</h2>
    <a href="{{ route('stamp_add.create') }}" class="btn btn-primary mb-3"> Шинэ Тамга бүртгэх</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Хэрэглэгч</th>
                <th>Тамга</th>
                <th>Огноо</th>
                <th> Үйлдэл</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stampHistories as $history)
                <tr>
                    <td>{{ $history->customer->firstname ?? 'N/A' }} {{ $history->customer->lastname ?? '' }}</td>
                    <td>{{ $history->stamp->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($history->created_at)->format('Y-m-d') }}</td>
                    <td class="d-flex gap-2">
                        <form action="{{ route('stamp_add.destroy', $history->id) }}" method="POST" onsubmit="return confirm('Устгах уу?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"> Устгах</button>
                        </form>
                        <a href="{{ route('stamp_add.edit', $history->id) }}" class="btn btn-sm btn-primary"> Засах</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Бүртгэл олдсонгүй</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
