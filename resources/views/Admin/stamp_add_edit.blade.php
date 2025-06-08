@extends('voyager::master')

@section('content')
<div class="container py-4">
    <h2>Тамга засах</h2>

    <form action="{{ route('stamp_add.update', $stampHistory->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Олон хэрэглэгч сонгох --}}
        <div class="mb-3">
            <label for="customer_id" class="form-label"> Хэрэглэгч</label>
            <select name="customer_id[]" class="form-select select2" multiple required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}"
                        {{ $customer->id == $stampHistory->customer_id ? 'selected' : '' }}>
                        {{ $customer->firstname }} {{ $customer->lastname }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Олон тамга сонгох --}}
        <div class="mb-3">
            <label for="stamp_id" class="form-label"> Тамга</label>
            <select name="stamp_id[]" class="form-select select2" multiple required>
                @foreach($stamps as $stamp)
                    <option value="{{ $stamp->id }}"
                        {{ $stamp->id == $stampHistory->stamp_id ? 'selected' : '' }}>
                        {{ $stamp->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Огноо засах --}}
        <div class="mb-3">
            <label for="created_at" class="form-label">Огноо</label>
            <input type="date" name="created_at" class="form-control"
                   value="{{ \Carbon\Carbon::parse($stampHistory->created_at)->format('Y-m-d') }}" required>
        </div>

        <button type="submit" class="btn btn-success"> Хадгалах</button>
    </form>
</div>
@endsection

@section('javascript')
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Сонгох...",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
