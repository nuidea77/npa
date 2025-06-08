<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sign Up | NPA Website</title>

  <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/vendor.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/theme.min.css') }}">
</head>

<body class="d-flex align-items-center min-h-100">



<main id="content" role="main" class="main pt-0">
  <div class="container-fluid px-3">
    <div class="row">
      <div class="col-lg-8 d-none d-lg-flex justify-content-center align-items-center  bg-light" style="background: url('{{ asset('assets/img/about-cover.jpg') }}') no-repeat center center; background-size: cover;">


      </div>

      <div class="col-lg-4 d-flex justify-content-center align-items-center min-vh-lg-100">
        <div class="w-100 " style="max-width: 25rem;">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

          {{-- Чиний шинэ форм энд орлоо --}}
          <form action="{{ route('customer.register.submit') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
              @csrf
              <div class="mb-3 col-lg-6 col-md-6">
                <label for="firstname" class="form-label">@lang('register.first_name')</label>
                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="@lang('register.enter_first_name')" value="{{ old('firstname') }}" required>
                <div id="firstnameError" class="invalid-feedback">
                  @lang('register.error_first_name_mongolian')
                </div>
              </div>

              <div class="mb-3 col-lg-6 col-md-6">
                <label for="lastname" class="form-label">@lang('register.last_name')</label>
                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="@lang('register.enter_last_name')" value="{{ old('lastname') }}" required>
                <div id="lastnameError" class="invalid-feedback">
                  @lang('register.error_last_name_mongolian')
                </div>
              </div>



              <div class="mb-3 col-lg-6 col-md-6">
                  <label for="email" class="form-label">@lang('register.email')</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="@lang('register.enter_email')" value="{{ old('email') }}" required>
              </div>
              <div class="mb-3 col-lg-6 col-md-6">
                  <label for="phone" class="form-label">@lang('register.phone')</label>
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="@lang('register.enter_phone')" value="{{ old('phone') }}" required>
              </div>
              <div class="mb-3 col-lg-6 col-md-6">
                <label for="sex" class="form-label">@lang('register.sex')</label>
                <select name="sex" id="sex" class="form-select" required>
                    <option value="" disabled selected>@lang('register.select_sex')</option>
                    <option value="1">@lang('register.male')</option>
                    <option value="2">@lang('register.female')</option>
                </select>
            </div>

              <div class="mb-3 col-lg-6 col-md-6">
                  <label for="position" class="form-label">@lang('register.position')</label>
                  <select name="position" id="position" class="form-select" required>
                      <option value="" disabled selected>@lang('register.select_position')</option>
                      <option value="1">@lang('register.leader')</option>
                      <option value="2">@lang('register.senior_expert')</option>
                      <option value="3">@lang('register.expert')</option>
                      <option value="4">@lang('register.nature_guardian')</option>
                      <option value="5">@lang('register.assistant_nature_guardian')</option>
                  </select>
              </div>
              <div class="mb-3 col-lg-12 col-md-12">
                <label for="hz" class="form-label">@lang('register.protected_area')</label>
                <select name="hz" id="hz" class="form-select" required>
                    <option value="" disabled selected>@lang('register.select_protected_area')</option>
                    <option value="1">@lang('register.tarvagatai_nuru')</option>
                    <option value="2">@lang('register.orkhon_khondii')</option>
                    <option value="3">@lang('register.munkhkhairkhan')</option>
                    <option value="4">@lang('register.ikh_bogd_uul')</option>
                    <option value="5">@lang('register.myangan_ugalzat')</option>
                    <option value="6">@lang('register.nomrog')</option>
                    <option value="7">@lang('register.khar_us_nuur')</option>
                    <option value="8">@lang('register.achit_nuur')</option>
                    <option value="9">@lang('register.otgontenger')</option>
                    <option value="10">@lang('register.bogdkhan_uul')</option>
                    <option value="11">@lang('register.ulaan_taiga')</option>
                    <option value="12">@lang('register.dornod_mongol')</option>
                </select>
            </div>
              {{-- НУУЦ ҮГ --}}
              <div class="mb-3 col-lg-12 col-md-6">
                <label for="password" class="form-label">@lang('register.password')</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="@lang('register.enter_password')" required>
                <div id="passwordLengthError" class="invalid-feedback">@lang('register.error_password_min')</div>
            </div>

            {{-- НУУЦ ҮГ ДАВТАХ --}}
            <div class="mb-3 col-lg-12 col-md-6">
                <label for="password_confirmation" class="form-label">@lang('register.confirm_password')</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="@lang('register.confirm_password')" required>
                <div id="passwordMismatchError" class="invalid-feedback">@lang('register.error_password_confirmation')</div>
            </div>

            {{-- БҮРТГҮҮЛЭХ ТОВЧ --}}
            <button type="submit" class="btn btn-primary ">@lang('register.register')</button>
        </div>
        </form>

      </div>
    </div>
  </div>
</div>
</main>

<script src="{{ asset('assets/admin/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/theme.min.js') }}"></script>

{{-- Real-time Javascript шалгалтууд --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
  const mongolianRegex = /^[А-Яа-яӨөҮүЁё\s]+$/;
  const firstname = document.getElementById('firstname');
  const lastname = document.getElementById('lastname');
  const password = document.getElementById('password');
  const passwordConfirmation = document.getElementById('password_confirmation');

  const passwordLengthError = document.getElementById('passwordLengthError');
  const passwordMismatchError = document.getElementById('passwordMismatchError');
  const firstnameError = document.getElementById('firstnameError');
  const lastnameError = document.getElementById('lastnameError');

  function validateMongolian(input, error) {
      if (input.value !== '' && !mongolianRegex.test(input.value)) {
          input.classList.add('is-invalid');
          error.style.display = 'block';
      } else {
          input.classList.remove('is-invalid');
          error.style.display = 'none';
      }
  }

  function checkPasswordLength() {
      if (password.value.length > 0 && password.value.length < 8) {
          password.classList.add('is-invalid');
          passwordLengthError.style.display = 'block';
      } else {
          password.classList.remove('is-invalid');
          passwordLengthError.style.display = 'none';
      }
  }

  function checkPasswordMatch() {
      if (password.value !== passwordConfirmation.value) {
          passwordConfirmation.classList.add('is-invalid');
          passwordMismatchError.style.display = 'block';
      } else {
          passwordConfirmation.classList.remove('is-invalid');
          passwordMismatchError.style.display = 'none';
      }
  }

  firstname.addEventListener('input', () => validateMongolian(firstname, firstnameError));
  lastname.addEventListener('input', () => validateMongolian(lastname, lastnameError));
  password.addEventListener('input', checkPasswordLength);
  passwordConfirmation.addEventListener('input', checkPasswordMatch);
});
</script>

</body>
</html>
