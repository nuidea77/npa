<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
  <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/img/favicon.png') }}" />
 @yield('meta')

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>
    @include('layout.header')
    @yield('content')
    @include('layout.footer')

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>

    AOS.init({
      duration: 1200,
      easing: 'ease-in-out',
      once: false
    });
  document.addEventListener("DOMContentLoaded", function () {
    const toggler = document.querySelector('.menu-toggle');
    const collapseEl = document.getElementById('navbarsExample07XL');
    const openText = toggler.querySelector('.open-text');
    const closeText = toggler.querySelector('.close-text');

    collapseEl.addEventListener('show.bs.collapse', () => {
      openText.style.display = 'none';
      closeText.style.display = 'inline-block';
    });

    collapseEl.addEventListener('hide.bs.collapse', () => {
      openText.style.display = 'inline-block';
      closeText.style.display = 'none';
    });
  });
</script>

  </script>
</body>

</html>
