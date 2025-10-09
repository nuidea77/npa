<div class="container-fluid header">
    <nav class="navbar navbar-dark max-width-1920" aria-label="Main navigation">
        <div class="container-fluid d-flex justify-content-between align-items-center flex-nowrap">
            <a href="/" class="py-2 text-decoration-none">
                <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" style="max-width: 150px;" alt="Logo">
            </a>

            <div class="d-flex align-items-center gap-2 flex-nowrap">
                <?php
                $currentLocale = app()->getLocale();
                $newLocale = $currentLocale === 'mn' ? 'en' : 'mn';
                ?>

                <a class="btn btn-outline-light fw-semibold rounded-5 px-3"
                   href="/set-locale/<?php echo $newLocale; ?>">
                    <?php echo strtoupper($newLocale); ?>
                </a>

                @auth('customer')
                <a class="nav-link d-flex align-items-center p-0" href="{{ route('customer.dashboard') }}">
                    <div class="profile-avatar">
                        @if(auth('customer')->user()->avatar)
                            <img src="{{ asset('storage/' . auth('customer')->user()->avatar) }}"
                                 alt="Profile" class="rounded-circle">
                        @else
                            <div class="profile-initial">
                                {{ strtoupper(substr(auth('customer')->user()->firstname, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                </a>
                @else
                <a class="btn text-white p-0" href="/customer/signin">
                    <i class="bi bi-person-circle fs-3"></i>
                </a>
                @endauth

                <button class="navbar-toggler border-0 menu-toggle p-2" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL"
                        aria-controls="navbarsExample07XL" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon open-text"></span>
                    <span class="close-text text-white" style="display: none;">
                        <i class="bi bi-x-lg"></i> @lang("texts.close")
                    </span>
                </button>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="navbarsExample07XL">
            <ul class="navbar-nav justify-content-end d-flex ms-auto gap-1 py-3">
                <li class="nav-item me-5 dropdown">
                    <a href="#" class="nav-link fs-5 fw-bold dropdown-toggle" data-bs-toggle="dropdown">
                        @lang("texts.about-us")
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom">
                        <li><a class="dropdown-item" href="/about">@lang('texts.purpose')</a></li>
                        <li><a class="dropdown-item" href="/about">@lang("texts.about-us")</a></li>
                        <li><a class="dropdown-item" href="/about">@lang("texts.timeline")</a></li>
                        <li><a class="dropdown-item" href="/about">@lang("texts.team")</a></li>
                    </ul>
                </li>

                <li class="nav-item me-5 dropdown">
                    <a class="nav-link fs-5 fw-bold dropdown-toggle" data-bs-toggle="dropdown" href="/programs">
                        @lang("texts.programs")
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom">
                        @foreach($programs as $program)
                        <li><a class="dropdown-item" href="/program/{{ $program->id }}">{{ $program->title }}</a></li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item me-5 dropdown">
                    <a class="nav-link fs-5 fw-bold dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        @lang("texts.thg")
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom">
                        <li><a class="dropdown-item" href="/spa">@lang("texts.thg")</a></li>
                    </ul>
                </li>

                <li class="nav-item me-5 dropdown">
                    <a class="nav-link fs-5 fw-bold dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        @lang("texts.news")
                    </a>
                    <ul class="dropdown-menu dropdown-menu-custom">
                        <li><a class="dropdown-item" href="/posts">@lang("texts.news")</a></li>
                        <li><a class="dropdown-item" href="/faq">@lang("texts.faq")</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>

<style>
/* Dropdown menu */
.dropdown-menu-custom {
    border: none;
    border-radius: 8px;
    padding: 0.5rem 0;
    margin-top: 0.5rem;
}

.dropdown-menu-custom .dropdown-item {
    padding: 0.75rem 1.5rem;
    transition: background-color 0.2s;
    color: #333;
}

.dropdown-menu-custom .dropdown-item:hover {
    background-color: #f0f0f0;
}

/* Profile Avatar */
.profile-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid rgba(255, 255, 255, 0.5);
    flex-shrink: 0;
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-initial {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #007bff;
    color: white;
    font-weight: bold;
    font-size: 1.2rem;
}

/* Navbar toggler */
.navbar-toggler {
    flex-shrink: 0;
}

.navbar-toggler:focus {
    box-shadow: none;
}

/* Responsive */
@media (max-width: 992px) {
    .profile-avatar {
        width: 35px;
        height: 35px;
    }
}

@media (max-width: 576px) {
    .profile-avatar {
        width: 32px;
        height: 32px;
    }

    .btn-outline-light {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
}
.dropdown-menu-custom {
    border: none;
    border-radius: 12px;
    padding: 0.5rem 0;
    margin-top: 0.5rem;
    animation: fadeInDown 0.3s ease-in-out;
}

.dropdown-menu-custom .dropdown-item {
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
    color: #333;
    font-weight: 500;
}

.dropdown-menu-custom .dropdown-item:hover {
    color: white;
    transform: translateX(5px);
    padding-left: 2rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (window.innerWidth > 992) {
        const dropdowns = document.querySelectorAll('.navbar .dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('mouseenter', function() {
                this.querySelector('.dropdown-menu')?.classList.add('show');
            });
            dropdown.addEventListener('mouseleave', function() {
                this.querySelector('.dropdown-menu')?.classList.remove('show');
            });
        });
    }
});
</script>
