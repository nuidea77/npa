@extends('voyager::master')

@section('page_title', __('messages.manage_verification'))

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">{{ __('messages.customer_verification_requests') }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter by Status -->
    <form method="GET" action="{{ route('admin.custom.page') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="all" {{ request('status') === 'all' || request('status') === null ? 'selected' : '' }}>
                        {{ __('messages.all') }}
                    </option>
                    <option value="null" {{ request('status') === 'null' ? 'selected' : '' }}>
                        {{ __('messages.pending') }}
                    </option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                        {{ __('messages.approved') }}
                    </option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>
                        {{ __('messages.rejected') }}
                    </option>
                </select>
            </div>
        </div>
    </form>

    @if ($pendingRequests->isEmpty())
        <p class="text-center">{{ __('messages.no_requests_found') }}</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.customer_name') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>{{ __('messages.phone') }}</th>
                    <th>{{ __('messages.status') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingRequests as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->firstname }} {{ $customer->lastname }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>
                            @if (is_null($customer->verify_status))
                                <span class="badge bg-warning">{{ __('messages.pending') }}</span>
                            @elseif ($customer->verify_status === 1)
                                <span class="badge bg-success">{{ __('messages.approved') }}</span>
                            @elseif ($customer->verify_status === 0)
                                <span class="badge bg-danger">{{ __('messages.rejected') }}</span>
                            @endif
                        </td>
                        <td>
                            @if (is_null($customer->verify_status))
                                <a href="{{ route('admin.customer.verify', ['id' => $customer->id, 'status' => 1]) }}"
                                   class="btn btn-success btn-sm">{{ __('messages.approve') }}</a>
                                <a href="{{ route('admin.customer.verify', ['id' => $customer->id, 'status' => 0]) }}"
                                   class="btn btn-danger btn-sm">{{ __('messages.reject') }}</a>
                            @elseif ($customer->verify_status === 0)
                                <a href="{{ route('admin.customer.verify', ['id' => $customer->id, 'status' => 1]) }}"
                                   class="btn btn-success btn-sm">{{ __('messages.approve') }}</a>
                            @else
                                <span class="text-muted">{{ __('messages.no_action_available') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
