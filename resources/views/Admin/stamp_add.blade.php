@extends('voyager::master')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"> @lang('texts.stamp-history')</h2>
    <a href="{{ route('stamp_add.create') }}" class="btn btn-primary mb-3"> @lang('texts.stamp-add')</a>

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
          @foreach($stampHistories as $history)
<tr>
    <td>{{ $history->customer->firstname ?? 'N/A' }} {{ $history->customer->lastname ?? '' }}</td>
    <td>{{ $history->stamp->name ?? 'N/A' }}</td>
    <td>{{ $history->created_at ? $history->created_at->format('Y-m-d') : 'N/A' }}</td>

    <td class="d-flex gap-2">
        <!-- Edit товч -->
        <a href="{{ route('stamp_add.edit', [$history->customer_id, $history->stamp_id]) }}" class="btn btn-sm btn-primary">Засах</a>

        <!-- Delete товч -->
        <form action="{{ route('stamp_add.destroy', [$history->customer_id, $history->stamp_id]) }}" method="POST" onsubmit="return confirm('Устгах уу?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Устгах</button>
        </form>
    </td>
</tr>
@endforeach
        </tbody>
    </table>
</div>
@endsection
