<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>GKE Sinta Kuala Kapuas</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="{{ asset('home/assets/images/logo.png') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('home/css/styles.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <style>
        .text-limit {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Jumlah baris yang ingin Anda tampilkan */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="mainNav">
        <div class="container d-flex">
            <div class="" style="height: 50px">
                <a class="d-flex" href={{ route('homepage') }} style="height: 100%; text-decoration: none">
                    <img src="{{ asset('home/assets/images/logo.png') }}" alt="..." width="50" />
                    <h4 class="my-auto mx-3"><strong>Gereja</strong> Evangelis Kalimantan</h4>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                    aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
            </div>
            <div class="my-auto">
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto  py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="/#layanan">Layanan</a></li>
                        <li class="nav-item"><a class="nav-link" href="/#tentang-gereja">Tentang Gereja</a></li>
                        <li class="nav-item"><a class="nav-link" href="/#kegiatan-rutin">kegiatan Rutin</a></li>
                        <li class="nav-item"><a class="nav-link" href="/#pendeta">Pendeta</a></li>
                        <li class="nav-item"><a class="nav-link" href="/pengumuman">Pengumuman</a></li>
                        <li class="nav-item"><a class="nav-link btn btn-primary btn-sm"
                                href="{{ route('login') }}"><strong>Login</strong></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <section class="">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Pengumuan
                </div>
                <div class="card-body">
                    <div class="d-flex align-middle">
                        <h5 class="card-title">{{ $data->judul }}</h5>
                        <small class="ms-auto">{{ $data->created_at->isoFormat('D MMMM Y') }}</small>
                    </div>
                    <hr>

                    <p class="card-text mt-3">{!! $data->isi !!}.</p>
                    <a href="{{ route('pengumuman') }}">
                        << Kembali</a>
                </div>
            </div>
        </div>
    </section>



    <!-- Contact-->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-9">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jl. S.Parman No.88, Selat Hilir, Kec. Selat, Kab. Kapuas, Kalimantan Tengah</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>(0513) 21123/21650</p>
                    </div>
                    <div class="col-lg-3 col-md-10">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Lokasi Gereja</h4>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.2819977247077!2d114.38448717405511!3d-3.018714196957212!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de46ef402525567%3A0x6fc71aeb04fc1d85!2sGereja%20SINTA!5e0!3m2!1sid!2sid!4v1697425343748!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('home/js/scripts.js') }}"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
