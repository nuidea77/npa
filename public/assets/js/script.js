var swiper = new Swiper(".teamSwiper", {
  slidesPerView: 2,
  spaceBetween: 30,
  breakpoints: {
    1920: {
      slidesPerView: 6,
      spaceBetween: 40,
    },

    1280: {
      slidesPerView: 6,
      spaceBetween: 40,
    },
    1024: {
      slidesPerView: 5,
      spaceBetween: 40,
    },
    768: {
      slidesPerView: 4,
      spaceBetween: 30,
    },
    640: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
    320: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
  }
})

var swiper = new Swiper(".carouselSwiper", {
  pagination: {
    el: ".swiper-pagination",
  },
  autoplay: {
    delay: 2500,
  },
});
var swiper = new Swiper(".placeSwiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

function myFunction() {

    // JavaScript to handle onchange events for the dropdowns
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('placeSearchForm');

        // Add onchange event listeners to the dropdowns
        document.getElementById('province').addEventListener('change', function () {
            form.submit();
        });

        document.getElementById('place_name').addEventListener('change', function () {
            form.submit();
        });
    });

};


(() => {
  'use strict'

  document.querySelector('#navbarSideCollapse').addEventListener('click', () => {
    document.querySelector('.offcanvas-collapse').classList.toggle('open')
  })
})();











