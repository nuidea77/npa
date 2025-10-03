@extends('voyager::master')

@section('head')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            border: 1px solid #ddd;
            border-radius: 4px;
            height: 38px;
            padding: 6px 12px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
    </style>
@endsection

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="voyager-edit"></i> Тамга засах
                    </h3>
                </div>

                <div class="panel-body">
                    {{-- Error Alert --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Алдаа гарлаа!</strong>
                            <ul class="mb-0" style="margin-top: 10px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('stamp_add.update', [$stampHistory->protected_area_id, $stampHistory->stamp_id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Хамгаалалттай газар сонгох (SINGLE) --}}
                        <div class="form-group">
                            <label for="protected_area_id" class="control-label">
                                <i class="voyager-location"></i> Хамгаалалттай газар
                                <span class="text-danger">*</span>
                            </label>
                            <select name="protected_area_id"
                                    id="protected_area_id"
                                    class="form-control select2-single"
                                    required>
                                <option value="">-- Сонгох --</option>
                                @foreach($protectedAreas as $area)
                                    <option value="{{ $area->id }}"
                                            {{ old('protected_area_id', $stampHistory->protected_area_id) == $area->id ? 'selected' : '' }}>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Засах үед зөвхөн 1 газар сонгох боломжтой</small>
                        </div>

                        {{-- Тамга сонгох (SINGLE) --}}
                        <div class="form-group">
                            <label for="stamp_id" class="control-label">
                                <i class="voyager-trophy"></i> Тамга
                                <span class="text-danger">*</span>
                            </label>
                            <select name="stamp_id"
                                    id="stamp_id"
                                    class="form-control select2-single"
                                    required>
                                <option value="">-- Сонгох --</option>
                                @foreach($stamps as $stamp)
                                    <option value="{{ $stamp->id }}"
                                            {{ old('stamp_id', $stampHistory->stamp_id) == $stamp->id ? 'selected' : '' }}>
                                        {{ $stamp->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Засах үед зөвхөн 1 тамга сонгох боломжтой</small>
                        </div>

                        {{-- Огноо засах --}}
                        <div class="form-group">
                            <label for="assigned_date" class="control-label">
                                <i class="voyager-calendar"></i> Огноо
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date"
                                   id="assigned_date"
                                   name="assigned_date"
                                   class="form-control"
                                   value="{{ old('assigned_date', $stampHistory->assigned_date ? $stampHistory->assigned_date->format('Y-m-d') : date('Y-m-d')) }}"
                                   max="{{ date('Y-m-d') }}"
                                   required>
                            <small class="text-muted">Тамга олгосон огноо (Өнөөдрөөс хойш байж болохгүй)</small>
                        </div>

                        {{-- Бүртгэсэн огноо харуулах --}}
                        <div class="form-group">
                            <label class="control-label">
                                <i class="voyager-clock"></i> Анх бүртгэсэн
                            </label>
                            <p class="form-control-static text-muted">
                                {{ $stampHistory->created_at ? $stampHistory->created_at->format('Y-m-d H:i:s') : 'N/A' }}
                            </p>
                        </div>

                        {{-- Buttons --}}
                        <div class="form-group">
                            <div class="btn-group pull-right">
                                <a href="{{ route('stamp_add.index') }}" class="btn btn-default">
                                    <i class="voyager-x"></i> Болих
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="voyager-check"></i> Хадгалах
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Warning Panel --}}
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="voyager-warning"></i> Анхааруулга
                    </h4>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li><i class="voyager-dot-circled"></i> Засах үед зөвхөн 1 газар болон 1 тамга сонгох боломжтой</li>
                        <li><i class="voyager-dot-circled"></i> Хэрэв олон тамга шинэчлэх бол устгаад дахин үүсгэнэ үү</li>
                        <li><i class="voyager-dot-circled"></i> Давхар бүртгэл үүсгэх боломжгүй</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Select2 initialization for single select
            $('.select2-single').select2({
                placeholder: 'Сонгох...',
                allowClear: true,
                width: '100%',
                theme: 'default'
            });

            // Auto-hide alerts
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Form validation with confirmation
            $('form').submit(function(e) {
                let protectedArea = $('#protected_area_id option:selected').text();
                let stamp = $('#stamp_id option:selected').text();
                let date = $('#assigned_date').val();

                if (!confirm(`Дараах мэдээллийг шинэчлэх үү?\n\nГазар: ${protectedArea}\nТамга: ${stamp}\nОгноо: ${date}`)) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection
