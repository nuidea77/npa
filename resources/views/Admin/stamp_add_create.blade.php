@extends('voyager::master')

@section('head')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ddd;
            border-radius: 4px;
            min-height: 38px;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #66afe9;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102,175,233,.6);
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
                        <i class="voyager-trophy"></i> Тамга оноох
                    </h3>
                </div>

                <div class="panel-body">
                    {{-- Success Alert --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="voyager-check"></i> {{ session('success') }}
                        </div>
                    @endif

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

                    <form action="{{ route('stamp_add.store') }}" method="POST">
                        @csrf

                        {{-- Хамгаалалттай газар сонгох --}}
                        <div class="form-group">
                            <label for="protected_area_id" class="control-label">
                                <i class="voyager-location"></i> Хамгаалалттай газар
                                <span class="text-danger">*</span>
                            </label>
                            <select name="protected_area_id[]"
                                    id="protected_area_id"
                                    class="form-control select2-multiple"
                                    multiple
                                    required>
                                @foreach($protectedAreas as $area)
                                    <option value="{{ $area->id }}"
                                            {{ in_array($area->id, old('protected_area_id', [])) ? 'selected' : '' }}>
                                        {{ $area->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Олон газар сонгож болно</small>
                        </div>

                        {{-- Тамга сонгох --}}
                        <div class="form-group">
                            <label for="stamp_id" class="control-label">
                                <i class="voyager-trophy"></i> Тамга
                                <span class="text-danger">*</span>
                            </label>
                            <select name="stamp_id[]"
                                    id="stamp_id"
                                    class="form-control select2-multiple"
                                    multiple
                                    required>
                                @foreach($stamps as $stamp)
                                    <option value="{{ $stamp->id }}"
                                            {{ in_array($stamp->id, old('stamp_id', [])) ? 'selected' : '' }}>
                                        {{ $stamp->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Олон тамга сонгож болно</small>
                        </div>

                        {{-- Огноо сонгох --}}
                        <div class="form-group">
                            <label for="assigned_date" class="control-label">
                                <i class="voyager-calendar"></i> Огноо
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date"
                                   id="assigned_date"
                                   name="assigned_date"
                                   class="form-control"
                                   value="{{ old('assigned_date', date('Y-m-d')) }}"
                                   max="{{ date('Y-m-d') }}"
                                   required>
                            <small class="text-muted">Тамга олгосон огноо</small>
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

            {{-- Info Panel --}}
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="voyager-info-circled"></i> Тайлбар
                    </h4>
                </div>
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <li><i class="voyager-dot-circled"></i> Олон хамгаалалттай газар, олон тамга сонгож болно</li>
                        <li><i class="voyager-dot-circled"></i> Давхар бүртгэл автоматаар хасагдана</li>
                        <li><i class="voyager-dot-circled"></i> Огноо өнөөдрөөс хойш байж болохгүй</li>
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
            // Select2 initialization
            $('.select2-multiple').select2({
                placeholder: function() {
                    return $(this).data('placeholder') || 'Сонгох...';
                },
                allowClear: true,
                width: '100%',
                theme: 'default'
            });

            // Protected Area placeholder
            $('#protected_area_id').data('placeholder', 'Хамгаалалттай газар сонгох...');

            // Stamp placeholder
            $('#stamp_id').data('placeholder', 'Тамга сонгох...');

            // Auto-hide alerts
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Form validation
            $('form').submit(function(e) {
                let protectedAreas = $('#protected_area_id').val();
                let stamps = $('#stamp_id').val();

                if (!protectedAreas || protectedAreas.length === 0) {
                    alert('Хамгаалалттай газар сонгоно уу!');
                    e.preventDefault();
                    return false;
                }

                if (!stamps || stamps.length === 0) {
                    alert('Тамга сонгоно уу!');
                    e.preventDefault();
                    return false;
                }

                // Confirm before submit
                let areaCount = protectedAreas.length;
                let stampCount = stamps.length;
                let totalRecords = areaCount * stampCount;

                if (!confirm(`${areaCount} газар × ${stampCount} тамга = ${totalRecords} бүртгэл үүсгэх гэж байна. Үргэлжлүүлэх үү?`)) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection
