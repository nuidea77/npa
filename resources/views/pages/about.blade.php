@extends('layout.main')
@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-lg-12" style="background-image: url(assets/img/about-cover.jpg); background-size: cover; background-position: center; height: 650px;">
      </div>
    </div>
    <div class="row py-5">
            <div class="col-lg-12">
               <a href="{{ url()->previous() }}" class="float-start program-date text-decoration-none">
    <i class="bi bi-chevron-left"></i> @lang('texts.back')
</a>
            </div>
        </div>
  </div>
  <div class="container py-5">
    <div class="row">

      <div class="col-lg-6">
        <h1 class="text-center fw-bold about-title ">Бидний тухай</h1>
      </div>
      <div class="col-lg-6 ">
        <p class="about-desc">
          Анх 2012 онд Хөвсгөл нуурын байгалийн цогцолборт газрыг хамгаалах, менежментийг нь сайжруулах зорилгоор “Lake Hovsgol Conservancy” хөтөлбөрийг эхлүүлснээр Монгол орны тусгай хамгаалалттай газрын менежментийг сайжруулах, менежментийн төлөвлөгөөг олон улсын стандартад нийцүүлэн боловсруулах, байгаль хамгаалагчдын мэргэжлийн ур чадварыг сайжруулах, чадавхжуулах, орон нутгийн иргэдийг аялал жуулчлалын чиглэлээр орлогоо нэмэгдүүлэхэд туслах талаар сургалтуудыг зохион явуулж ирсэн. 2021 оноос үйл ажиллагаа, цархүрээгээ өргөжүүлж “National Park Academy” нэрийн дор Монгол улсын нийт тусгай хамгаалалттай газруудад хүрч ажиллахыг зорьж байна
        </p>
      </div>
    </div>
  </div>

  <section class="timeline">
  <div class="container  py-5">
    <div class="row">
      <div class="col-lg-12 py-5 ">
        <h4 class="text-center fw-bold ">Он цагийн хэлхээс</h4>
      </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <ul class="timeline-list">
                <!-- Single Experience -->
                <li>
                    <div class="timeline_content">
                        <h4>2012 он</h4>
                        <p>Хөвсгөл нуурын БЦГ-ын 25 жилийн менежментийн төлөвлөгөө</p>
                    </div>
                </li>
                <li>
                    <div class="timeline_content">
                        <h4>2013 он</h4>
                        <p>“Бид хайрлаж чадна” аян</p>
                    </div>
                </li>
                <li>
                    <div class="timeline_content">
                        <h4>2014 он</h4>
                        <p>АНУ-ын Тусгай Хамгаалалттай Газрын мэргэжилтнүүдтэй хамтарсан сургалт</p>
                    </div>
                </li>
                <li>
                    <div class="timeline_content">
                        <h4>2014 он</h4>
                        <p>Хөвсгөл нуурын морин аяллын маршрут</p>
                    </div>
                </li>
                <!-- Single Experience -->
                <li>
                    <div class="timeline_content">
                        <h4>2015 он</h4>
                        <p>АНУ-ын Yosemite парктай эгч дүү парк болсон</p>
                    </div>
                </li>
                <li>
                    <div class="timeline_content">
                        <h4>2015 он</h4>
                        <p>Хөвсгөл нуурын БЦГ-ын нэвтрэх цэгийн хяналт</p>
                    </div>
                </li>
                <!-- Single Experience -->
                <li>
                    <div class="timeline_content">
                        <h4>2016 он</h4>
                        <p>Улаан тайга БЦГ-ын менежментийн төлөвлөгөө</p>
                    </div>
                </li>
                <li>
                    <div class="timeline_content">
                        <h4>2016 он</h4>
                        <p>Соёлын өв, байгалийн өвийг тайлбарлах сургалт</p>
                    </div>
                </li>
                <!-- Single Experience -->
                <li>
                    <div class="timeline_content">
                        <h4>2019 он</h4>
                        <p>Өмнөговь аймагт “Гэр” техникийн туслалцаа үзүүлэх төсөл</p>
                    </div>
                </li>
                <!-- Single Experience -->
                <li>
                    <div class="timeline_content">
                        <h4>2021 он</h4>
                        <p>Сүхбаатар, Дорнод аймгийн ТХГ-т соёлын өв, байгалийн өвийг тайлбарлах сургалт</p>
                    </div>
                </li>
                <!-- Single Experience -->
                <li>
                    <div class="timeline_content">
                        <h4>2024.04.25-26</h4>
                        <p>“Тусгай Хамгаалалтай Газар – Үндэсний бахархал” Хуралдай, “National Park Academy” хөтөлбөрийн албан ёсны нээлт</p>
                    </div>
                </li>
                <!-- Single Experience -->
                <li>
                    <div class="timeline_content">
                        <h4>2024.06.17-26</h4>
                        <p>Өсвөрийн байгаль хамгаалагчдыг бэлтгэх, туршлага солилцох хөтөлбөр</p>
                    </div>
                </li>
            </ul>
        </div>

    </div>

  </div>

  </section>

  <section>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12 ">
                <h4 class="team-title text-center ">Хамт олон</h4>
            </div>
        </div>
        <div class="row py-5">
            <!-- Modal -->
            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content container">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4 pb-2 ">
                                    <img id="modalImage" src="" class="img-fluid"  alt="Team Member">
                                </div>
                                <div class="col-lg-8">
                                    <h4 id="modalName" class="team_name"></h4>
                                    <p id="modalPosition" class="team_position"></p>
                                    <p id="modalBio"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Swiper -->
            <div class="swiper teamSwiper">
                <div class="swiper-wrapper">
                    @if (isset($teams))
        @foreach ($teams as $member)
                    <div class="swiper-slide" data-bs-toggle="modal" data-bs-target="#exampleModalToggle"
                         onclick="showTeamMember('{{ $member->name }}', '{{ $member->position }}', '{{ Voyager::image($member->image) }}', '{{ $member->bio }}')">
                        <div class="team_member">
                            <img src="{{ Voyager::image($member->image) }}" class="img-fluid rounded-circle" alt="{{ $member->name }}">
                            <h4 class="team_name text-center">{{ $member->name }}</h4>
                            <p class="team_position">{{ $member->position }}</p>
                        </div>
                    </div>
                    @endforeach
      @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTeamMember(name, position, image, bio) {
            document.getElementById('modalName').innerText = name;
            document.getElementById('modalPosition').innerText = position;
            document.getElementById('modalImage').src = image;
            document.getElementById('modalBio').innerText = bio;
        }
    </script>

  </section>
  @stop
