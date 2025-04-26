<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@lang('signin.title')</title>

  <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/vendor.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/theme.min.css') }}">
</head>

<body class="d-flex align-items-center min-vh-100">

<main id="content" role="main" class="main pt-0">
  <div class="container-fluid px-3">
    <div class="row">
      <!-- Background image side -->
      <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center bg-light"
           style="background: url('{{ asset('assets/img/about-cover.jpg') }}') no-repeat center center; background-size: cover;">
      </div>

      <!-- Form side -->
      <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100">
        <div class="w-100" style="max-width: 25rem;">

          {{-- Error Alerts --}}
          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>@lang('signin.error_title')</strong>
              <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          {{-- Sign-In Form --}}
          <form action="{{ route('customer.signin.submit') }}" method="POST">
              @csrf

              <div class="mb-3">
                  <label for="email" class="form-label">@lang('signin.email')</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="@lang('signin.email_placeholder')" value="{{ old('email') }}" required>
              </div>

              <div class="mb-3">
                  <label for="password" class="form-label">@lang('signin.password')</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="@lang('signin.password_placeholder')" required>
              </div>

              <button type="submit" class="btn btn-primary w-100">@lang('signin.signin')</button>

          </form>

          {{-- Links --}}
          <div class="text-center mt-3">
              {{-- <a href="{{ route('password.request') }}" class="text-decoration-none">@lang('signin.forgot_password')</a> --}}
          </div>
          <div class="text-center mt-2">
              <p>@lang('signin.no_account') <a href="{{ route('customer.register') }}" class="text-decoration-none">@lang('signin.signup')</a></p>
          </div>

        </div>
      </div>

    </div>
  </div>
</main>

<script src="{{ asset('assets/admin/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/theme.min.js') }}"></script>

</body>
</html>
