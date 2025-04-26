<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
  <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/img/favicon.png') }}" />
  <title>National Park Academy | Explore Nature & Learning</title>
  <meta name="description" content="Discover the wonders of nature and education at National Park Academy. Explore programs, courses, and conservation efforts.">
  <meta name="keywords" content="National Park, Academy, Education, Conservation, Wildlife, Nature">
  <meta name="author" content="National Park Academy">
  <link rel="canonical" href="{{ url()->current() }}">

  <!-- Open Graph Meta Tags -->
  <meta property="og:title" content="National Park Academy | Explore Nature & Learning">
  <meta property="og:description" content="Discover the wonders of nature and education at National Park Academy. Explore programs, courses, and conservation efforts.">
  <meta property="og:image" content="{{ asset('assets/images/cover.jpg') }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="National Park Academy | Explore Nature & Learning">
  <meta name="twitter:description" content="Discover the wonders of nature and education at National Park Academy. Explore programs, courses, and conservation efforts.">
  <meta name="twitter:image" content="{{ asset('assets/images/cover.jpg') }}">

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
  </script>
</body>

</html>
