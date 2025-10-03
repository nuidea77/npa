@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="voyager-trophy"></i> Тамгийн түүх
                    </h3>
                </div>

                <div class="panel-body">
                    {{-- Alerts --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="voyager-check"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="voyager-x"></i> {{ session('error') }}
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <i class="voyager-info-circled"></i> {{ session('info') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade in">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Action Button --}}
                    <div class="mb-3" style="margin-bottom: 15px;">
                        <a href="{{ route('stamp_add.create') }}" class="btn btn-success">
                            <i class="voyager-plus"></i> Тамга нэмэх
                        </a>
                    </div>

                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr class="bg-light">
                                    <th width="5%">#</th>
                                    <th width="35%">
                                        <i class="voyager-location"></i> Хамгаалалттай газар
                                    </th>
                                    <th width="30%">
                                        <i class="voyager-trophy"></i> Тамга
                                    </th>
                                    <th width="15%">
                                        <i class="voyager-calendar"></i> Огноо
                                    </th>
                                    <th width="15%" class="text-center">
                                        <i class="voyager-settings"></i> Үйлдэл
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stampHistories as $index => $history)
                                    <tr>
                                        <td>{{ $stampHistories->firstItem() + $index }}</td>
                                        <td>
                                            <strong>{{ $history->protectedArea->name ?? 'N/A' }}</strong>
                                        </td>
                                        <td>{{ $history->stamp->name ?? 'N/A' }}</td>
                                        <td>
                                            <span class="label label-default">
                                                {{ $history->assigned_date ? $history->assigned_date->format('Y-m-d') : 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="text-center no-wrap">
                                            {{-- Edit Button --}}
                                            <a href="{{ route('stamp_add.edit', [$history->protected_area_id, $history->stamp_id]) }}"
                                               class="btn btn-sm btn-primary"
                                               title="Засах">
                                                <i class="voyager-edit"></i>
                                            </a>

                                            {{-- Delete Button --}}
                                            <button type="button"
                                                    class="btn btn-sm btn-danger delete-btn"
                                                    data-id="{{ $history->id }}"
                                                    data-protected-area="{{ $history->protected_area_id }}"
                                                    data-stamp="{{ $history->stamp_id }}"
                                                    title="Устгах">
                                                <i class="voyager-trash"></i>
                                            </button>

                                            {{-- Hidden Delete Form --}}
                                            <form id="delete-form-{{ $history->id }}"
                                                  action="{{ route('stamp_add.destroy', [$history->protected_area_id, $history->stamp_id]) }}"
                                                  method="POST"
                                                  style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            <i class="voyager-info-circled"></i>
                                            Мэдээлэл байхгүй байна
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($stampHistories->hasPages())
                        <div class="text-center">
                            {{ $stampHistories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
$(document).ready(function() {
    // Delete confirmation
    $('.delete-btn').click(function() {
        let id = $(this).data('id');
        let protectedArea = $(this).closest('tr').find('td:eq(1)').text().trim();
        let stamp = $(this).closest('tr').find('td:eq(2)').text().trim();

        if (confirm(`"${protectedArea}" - "${stamp}" холбоосыг устгах уу?`)) {
            $('#delete-form-' + id).submit();
        }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>

<style>
.no-wrap {
    white-space: nowrap;
}
.panel-heading h3 {
    margin: 0;
}
.btn-sm {
    margin: 0 2px;
}
.bg-light {
    background-color: #f5f5f5;
}
</style>
@endsection
