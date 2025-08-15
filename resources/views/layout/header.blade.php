<div class="container-fluid header">

    <nav class="navbar navbar-dark " aria-label="Ninth navbar example">
<div class="container-fluid d-flex justify-content-between">
      <a href="/" class="w-60 py-2  align-items-center mb-md-0 me-md-auto text-decoration-none">
        <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" width="200px"  alt="" >
      </a>
        <?php
        $currentLocale = app()->getLocale();
        $newLocale = $currentLocale === 'en' ? 'mn' : 'en';
        ?>
        <a class="btn  btn-outline-light fw-semibold rounded-5  mx-3"
           href="/set-locale/<?php echo $newLocale; ?>">
          <?php echo strtoupper($newLocale); ?>
        </a>


  <button class="navbar-toggler border-0 menu-toggle" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL"
        aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon open-text"></span>
  <span class="close-text text-white " style="display: none;">
    <i class="bi bi-x-lg"></i> @lang("texts.close")
  </span>
</button>



    </div>
      <div class="collapse navbar-collapse" id="navbarsExample07XL">
        <ul class="navbar-nav justify-content-end d-flex ms-auto  gap-1 py-3">

          <li class="nav-item me-5  dropdown ">
            <a href="#" class="nav-link fs-5 fw-bold dropdown-toggle" data-bs-toggle="dropdown">@lang("texts.about-us")</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/about">@lang('texts.purpose')</a></li>
                <li><a class="dropdown-item" href="/about">@lang("texts.about-us")</a></li>
                <li><a class="dropdown-item" href="/about">@lang("texts.timeline")</a></li>
                <li><a class="dropdown-item" href="/about">@lang("texts.team")</a></li>
            </ul>
          </li>

          <li class="nav-item me-5   ">
            <a class="nav-link fs-5 fw-bold" href="/programs">@lang("texts.programs")</a>
          </li>

          <li class="nav-item me-5  dropdown ">
            <a class="nav-link fs-5 fw-bold dropdown-toggle" href="#" data-bs-toggle="dropdown">@lang("texts.thg")</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/spa">@lang("texts.thg")</a></li>
              <li><a class="dropdown-item" href="/customer/signin">@lang("texts.login")</a></li>
            </ul>
          </li>

          <li class="nav-item me-5  dropdown ">
            <a class="nav-link fs-5 fw-bold dropdown-toggle" href="#" data-bs-toggle="dropdown">@lang("texts.news")</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/posts">@lang("texts.news")</a></li>
              <li><a class="dropdown-item" href="/faq">@lang("texts.faq")</a></li>
            </ul>
          </li>



        </ul>
      </div>
    </nav>
  </div>
