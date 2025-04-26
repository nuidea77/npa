<header id="header" class="navbar navbar-expand-lg navbar-bordered bg-white  ">
    <div class="container">
      <nav class="js-mega-menu navbar-nav-wrap">
        <!-- Logo -->


        <!-- End Logo -->

        <!-- Secondary Content -->
        <div class="navbar-nav-wrap-secondary-content">
          <!-- Navbar -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <!-- Account -->
              @auth('customer')
                <div class="dropdown">
                  <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
                    <div class="avatar avatar-sm avatar-circle">
                      <img class="avatar-img" src="{{ asset('storage/' . Auth::guard('customer')->user()->avatar) }}" alt="Image" onerror="this.onerror=null;this.src='{{ asset('assets/img/user.png') }}';">
                      <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                    </div>
                  </a>

                  <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account" aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                    <div class="dropdown-item-text">
                      <div class="d-flex align-items-center">

                        <div class="flex-grow-1 ms-3">
                          <h5 class="mb-0">{{ Auth::guard('customer')->user()->firstname }} {{ Auth::guard('customer')->user()->lastname }}</h5>
                          <p class="card-text text-body">{{ Auth::guard('customer')->user()->email }}</p>
                        </div>
                      </div>
                    </div>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('customer.edit') }}">@lang('customer.profile_and_account')</a>
                    <a class="dropdown-item" href="{{ route('customer.dashboard') }}">@lang('customer.settings')</a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      @lang('register.logout')
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </div>
                </div>
              @else
                <a href="{{ route('customer.signin') }}" class="btn btn-primary">@lang('customer.login')</a>
              @endauth
              <!-- End Account -->
            </li>
          </ul>
          <!-- End Navbar -->
        </div>
        <!-- End Secondary Content -->

        <!-- Toggler -->

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarContainerNavDropdown">


        </div>
        <!-- End Collapse -->
      </nav>
    </div>
</header>
