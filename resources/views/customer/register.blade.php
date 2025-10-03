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
        {{-- Сайжруулсан Modal HTML --}}
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      {{-- Success Icon Header --}}
      <div class="modal-body text-center p-5">
        {{-- Success Icon with Animation --}}
        <div class="mb-4">
          <div class="avatar avatar-xxl avatar-circle bg-soft-success mx-auto">
            <span class="avatar-initials">
              <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-success">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
            </span>
          </div>
        </div>

        {{-- Title --}}
     <h3 class="modal-title mb-3" id="successModalLabel">{{ __('auth.title') }}</h3>

{{-- Message --}}
<p class="text-muted mb-1">{{ __('auth.msg1') }}</p>
<p class="text-muted mb-4">{{ __('auth.msg2') }}</p>

{{-- Action Button --}}
<a href="{{ url('/') }}" class="btn btn-primary btn-lg px-5">
  <i class="bi bi-check-circle me-2"></i>{{ __('auth.button') }}
</a>

      </div>
    </div>
  </div>
</div>

{{-- Modal Animation CSS --}}
<style>
#successModal .modal-content {
  border-radius: 1rem;
  overflow: hidden;
}

#successModal .avatar-xxl {
  width: 6rem;
  height: 6rem;
  animation: scaleIn 0.5s ease-out;
}

#successModal .bg-soft-success {
  background-color: rgba(0, 201, 167, 0.1);
}

#successModal .avatar-circle {
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

#successModal .modal-title {
  font-weight: 600;
  color: #1e2022;
  font-size: 1.5rem;
}

#successModal .btn-primary {
  border-radius: 0.5rem;
  font-weight: 600;
  transition: all 0.3s ease;
}

#successModal .btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(55, 125, 255, 0.4);
}

@keyframes scaleIn {
  0% {
    transform: scale(0);
    opacity: 0;
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

/* Modal backdrop blur effect */
#successModal.show ~ .modal-backdrop {
  backdrop-filter: blur(5px);
}

/* Fade in animation for content */
#successModal .modal-body > * {
  animation: fadeInUp 0.6s ease-out forwards;
  opacity: 0;
}

#successModal .modal-body > *:nth-child(1) { animation-delay: 0.1s; }
#successModal .modal-body > *:nth-child(2) { animation-delay: 0.2s; }
#successModal .modal-body > *:nth-child(3) { animation-delay: 0.3s; }
#successModal .modal-body > *:nth-child(4) { animation-delay: 0.4s; }

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>

{{-- Modal JavaScript --}}
@if(session('success_message'))
<script>
    window.addEventListener('load', function () {
        var modalElement = document.getElementById('successModal');
        if (modalElement) {
            var successModal = new bootstrap.Modal(modalElement, {
                backdrop: 'static',
                keyboard: false
            });
            successModal.show();

            // Modal хаагдахад нүүр хуудас руу шилжүүлэх
            modalElement.addEventListener('hidden.bs.modal', function () {
                window.location.href = '{{ url("/") }}';
            });
        }
    });
</script>
@endif

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
               <small id="email-error" class="text-danger"></small>
                </div>
              <div class="mb-3 col-lg-6 col-md-6">
                  <label for="phone" class="form-label">@lang('register.phone')</label>
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="@lang('register.enter_phone')" value="{{ old('phone') }}" required>
              <small id="phone-error" class="text-danger"></small>
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
                <label for="protected_area_id" class="form-label">@lang('register.protected_area')</label>
                <select name="protected_area_id" id="protected_area_id" class="form-select" required>
                    <option value="" disabled selected>@lang('register.select_protected_area')</option>
                    @foreach($protected_areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                    @endforeach
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
  document.addEventListener("DOMContentLoaded", function () {

    const emailField = document.getElementById('email');
    const phoneField = document.getElementById('phone');
    const emailError = document.getElementById('email-error');
    const phoneError = document.getElementById('phone-error');

    // Имэйл валидаци
    emailField.addEventListener('input', function () {
      const email = emailField.value.trim();
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailRegex.test(email)) {
        emailError.textContent = 'Имэйл бичиглэл буруу байна. @ болон . ашиглана уу.';
      } else {
        emailError.textContent = '';
      }
    });

    // Утасны дугаар валидаци
    phoneField.addEventListener('input', function () {
      const phone = phoneField.value.trim();
      const phoneRegex = /^\d{8}$/;

      if (!phoneRegex.test(phone)) {
        phoneError.textContent = 'Утасны дугаар 8 оронтой цифр байх ёстой.';
      } else {
        phoneError.textContent = '';
      }
    });



  });

</script>

</body>
</html>
