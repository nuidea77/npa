@extends('voyager::master')

@section('head')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container mx-auto py-6 px-4">
    <div class="bg-white rounded-2xl shadow p-6 max-w-2xl mx-auto">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800"> Хэрэглэгчдэд тамга оноох</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('stamp_add.store') }}" method="POST">
            @csrf

            <!-- Хэрэглэгчид -->
            <div class="mb-4">
                <label for="customer_id" class="form-label font-semibold"> Хэрэглэгчид</label>
                <select name="customer_id[]" id="customer_id" class="form-select" multiple required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->firstname }} {{ $customer->lastname }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Тамганууд -->
            <div class="mb-4">
                <label for="stamp_id" class="form-label font-semibold"> Тамганууд</label>
                <select name="stamp_id[]" id="stamp_id" class="form-select" multiple required>
                    @foreach($stamps as $stamp)
                        <option value="{{ $stamp->id }}">{{ $stamp->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Огноо сонгох -->
<div class="mb-4">
    <label for="created_at" class="form-label font-semibold">Огноо сонгох</label>
    <input type="date" id="created_at" name="created_at" class="form-control" required>
</div>


            <!-- Submit button -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-xl">
                    Хадгалах
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
    <!-- jQuery + Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#customer_id').select2({
                placeholder: "Хэрэглэгч сонгох",
                allowClear: true,
                width: '100%'
            });

            $('#stamp_id').select2({
                placeholder: "Тамга сонгох",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection
