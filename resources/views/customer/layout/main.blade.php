<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Хэрэглэгчийн дашборд</title>

  <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/vendor.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/theme.min.css') }}">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <div class="body-wrapper-inner">
        @include('customer.layout.header')
        @yield('content')
        </div>
    </div>
  </div>
</main>

<script src="{{ asset('assets/admin/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/theme.min.js') }}"></script>

</body>
</html>
