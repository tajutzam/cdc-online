@extends('landing-page.layouts.app')
@section('content')
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="{{ route('/') }}" class="logo align-items-center">
                <img src="{{ asset('/') }}assets/img/logoblue.png" alt="">

            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
                    <li><a class="nav-link scrollto" href="#features">Fitur</a></li>
                    <li><a href="{{ route('blog') }}">Berita</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
                    <li><a class="getstarted scrollto" href="#hero">Unduh Sekarang</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <section id="hero" class="hero d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Satu Aplikasi, Untuk Alumni</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">Temukan Rekan Alumni dengan Cepat, dan Dapatkan
                        Informasi Lowongan
                        Terkini</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="#about"
                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <i class="bi bi-google-play pe-2 ms-0"></i><span>Unduh</span>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ asset('/') }}assets/img/hero-img.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">

            <div class="container" data-aos="fade-up">
                <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="content">
                            <h3>Tentang Aplikasi</h3>
                            <h2> Aplikasi CDC (Career Development & Counseling) Politeknik Negeri Jember</h2>
                            <p style="text-align: justify">
                                Adalah solusi inovatif yang
                                dirancang
                                dan dikembangkan oleh Teaching Factory Jurusan Teknologi Informasi di
                                Politeknik Negeri Jember sebagai upaya komitmen kami dalam membantu
                                mahasiswa dan alumni kami meraih sukses dalam perjalanan karir mereka.
                                Aplikasi ini memadukan teknologi informasi dengan keahlian profesional di
                                bidang karir untuk memberikan akses mudah dan komprehensif kepada berbagai
                                informasi dan layanan yang krusial untuk mencapai sukses di dunia kerja.

                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="{{ asset('/') }}assets/img/about.jpg" class="img-fluid" alt="">
                    </div>

                </div>
            </div>

        </section><!-- End About Section -->

        <!-- ======= Values Section ======= -->
        <section id="features" class="values">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Fitur Utama</h2>
                    <p>Dilengkapi dengan Kebutuhan Alumni</p>
                </header>

                <div class="row">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="box">
                            <img src="{{ asset('/') }}assets/img/values-1.png" class="img-fluid" alt="">
                            <h3>Temukan Alumni</h3>
                            <p>Temukan rekan Alumni Politeknik Negeri Jember dan buat Relasi anda.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
                        <div class="box">
                            <img src="{{ asset('/') }}assets/img/values-2.png" class="img-fluid" alt="">
                            <h3>Cari Lowongan</h3>
                            <p>Berisi Informasi Lowongan terbaru, akurat dan dapat dipercaya.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
                        <div class="box">
                            <img src="{{ asset('/') }}assets/img/values-3.png" class="img-fluid" alt="">
                            <h3>Kuesioner</h3>
                            <p>Pengisian Kuesioner yang sesuai dengan Tracer Study Kemdikbudristek RI, untuk mengetahui
                                jejak Karir Alumni
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Values Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts">
            <div class="container" data-aos="fade-up">

                <div class="row gy-3">

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-people"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $user }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Total Alumni Bekerja</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-people" style="color: #bb0852;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $notWork }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Total Alumni Belum Bekerja</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-mortarboard" style="color: #ee6c20;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $prodi }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Total Program Studi</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="bi bi-folder" style="color: #15be56;"></i>
                            <div>
                                <span data-purecounter-start="0" data-purecounter-end="{{ $post }}"
                                    data-purecounter-duration="1" class="purecounter"></span>
                                <p>Total Lowongan</p>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </section><!-- End Counts Section -->

        <!-- ======= Features Section ======= -->
        <section id="now" class="features">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Fitur Lanjutan</h2>
                    <p>Sarana Pelengkap yang mempermudah Alumni</p>
                </header>

                <div class="row">

                    <div class="col-lg-6">
                        <img src="{{ asset('/') }}assets/img/features.png" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                        <div class="row align-self-center gy-4">

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Berita Terkini</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="300">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Grup Whatsapp Alumni</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Temukan Lowongan Spesifik</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="500">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Web View IKAPJ</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="600">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Kemanan Akun</h3>
                                </div>
                            </div>


                        </div>
                    </div>

                </div> <!-- / row -->

                <!-- Feature Tabs -->
                {{-- <div class="row feture-tabs" data-aos="fade-up">
                    <div class="col-lg-6">
                        <h3>Kenapa Aplikasi ini Dibuat ?</h3>

                        <!-- Tabs -->
                        <ul class="nav nav-pills mb-3">
                            <li>
                                <a class="nav-link active" data-bs-toggle="pill" href="#tab1">Latar Belakang</a>
                            </li>
                            <li>
                                <a class="nav-link" data-bs-toggle="pill" href="#tab2">Voluptates</a>
                            </li>
                            <li>
                                <a class="nav-link" data-bs-toggle="pill" href="#tab3">Corrupti</a>
                            </li>
                        </ul><!-- End Tabs -->

                        <!-- Tab Content -->
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tab1">
                                <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita.
                                    Sapiente atque consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check2"></i>
                                    <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                                </div>
                                <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi
                                    dolorum non eveniet magni quaerat nemo et.</p>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check2"></i>
                                    <h4>Incidunt non veritatis illum ea ut nisi</h4>
                                </div>
                                <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta
                                    tenetur. Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at.
                                    Dolorem quo tempora. Quia et perferendis.</p>
                            </div><!-- End Tab 1 Content -->

                            <div class="tab-pane fade show" id="tab2">
                                <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita.
                                    Sapiente atque consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check2"></i>
                                    <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                                </div>
                                <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi
                                    dolorum non eveniet magni quaerat nemo et.</p>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check2"></i>
                                    <h4>Incidunt non veritatis illum ea ut nisi</h4>
                                </div>
                                <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta
                                    tenetur. Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at.
                                    Dolorem quo tempora. Quia et perferendis.</p>
                            </div><!-- End Tab 2 Content -->

                            <div class="tab-pane fade show" id="tab3">
                                <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita.
                                    Sapiente atque consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check2"></i>
                                    <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                                </div>
                                <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi
                                    dolorum non eveniet magni quaerat nemo et.</p>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check2"></i>
                                    <h4>Incidunt non veritatis illum ea ut nisi</h4>
                                </div>
                                <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta
                                    tenetur. Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at.
                                    Dolorem quo tempora. Quia et perferendis.</p>
                            </div><!-- End Tab 3 Content -->

                        </div>

                    </div>

                    <div class="col-lg-6">
                        <img src="{{ asset('/') }}assets/img/features-2.png" class="img-fluid" alt="">
                    </div>

                </div><!-- End Feature Tabs --> --}}

                <!-- Feature Icons -->
                <div class="row feature-icons" data-aos="fade-up">
                    <h3>Dilengkapi Web Admin</h3>

                    <div class="row">

                        <div class="col-xl-4 text-center" data-aos="fade-right" data-aos-delay="100">
                            <img src="{{ asset('/') }}assets/img/features-3.png" class="img-fluid p-4"
                                alt="">
                        </div>

                        <div class="col-xl-8 d-flex content">
                            <div class="row align-self-center gy-4">

                                <div class="col-md-6 icon-box" data-aos="fade-up">
                                    <i class="ri-line-chart-line"></i>
                                    <div>
                                        <h4>Statistik Alumni</h4>
                                        <p>Merekam Perkembangan dan Jejak Karir Alumni</p>
                                    </div>
                                </div>

                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                                    <i class="ri-stack-line"></i>
                                    <div>
                                        <h4>Monitoring Kuesioner</h4>
                                        <p>Pengamatan Kuesioner dengan Lengkap</p>
                                    </div>
                                </div>

                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                                    <i class="ri-brush-4-line"></i>
                                    <div>
                                        <h4>Validasi Lowongan</h4>
                                        <p>Cek Validasi Lowongan yang di unggah </p>
                                    </div>
                                </div>

                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                                    <i class="ri-magic-line"></i>
                                    <div>
                                        <h4>Akun Program Studi</h4>
                                        <p>Memiliki akun monitoring Alumni tiap Program Studi
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                                    <i class="ri-radar-line"></i>
                                    <div>
                                        <h4>Notifikasi</h4>
                                        <p>Pengiriman Notifikasi yang diperlukan untuk tiap Pengguna
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div><!-- End Feature Icons -->

            </div>

        </section><!-- End Features Section -->
        <!-- ======= F.A.Q Section ======= -->
        <section id="faq" class="faq">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Pertanyaan dari Pengguna</h2>
                    <p>Pertanyaan yang Sering Muncul</p>
                </header>

                <div class="row">
                    @foreach ($questions as $item)
                        <div class="col-lg-12">
                            <!-- F.A.Q List 1-->
                            <div class="accordion accordion-flush" id="faqlist1">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                                            {{ $item['questions'] }}
                                        </button>
                                    </h2>
                                    <div id="faq-content-1" class="accordion-collapse collapse"
                                        data-bs-parent="#faqlist1">
                                        <div class="accordion-body">
                                            {{ $item['answer'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </section><!-- End F.A.Q Section -->



        <!-- ======= Team Section ======= -->
        {{-- <section id="team" class="team">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Tim Kami</h2>
                    <p>CDC Online Politeknik Negeri Jember</p>
                </header>

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('/') }}assets/img/team/team-1.jpg" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Walter White</h4>
                                <span>Backend Developer</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('/') }}assets/img/team/team-2.jpg" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Sarah Jhonson</h4>
                                <span>Frontend Mobile Developer</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('/') }}assets/img/team/team-3.jpg" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>William Anderson</h4>
                                <span>Frontend Web Developer, UI/UX</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                        <div class="member">
                            <div class="member-img">
                                <img src="{{ asset('/') }}assets/img/team/team-4.jpg" class="img-fluid"
                                    alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Amanda Jepson</h4>
                                <span>UI/UX</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Team Section --> --}}

        <!-- ======= Clients Section ======= -->
        {{-- <section id="clients" class="clients">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Our Clients</h2>
                    <p>Temporibus omnis officia</p>
                </header>
                <div class="clients-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-1.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-2.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-3.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-4.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-5.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-6.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-7.png"
                                class="img-fluid" alt=""></div>
                        <div class="swiper-slide"><img src="{{ asset('/') }}assets/img/clients/client-8.png"
                                class="img-fluid" alt=""></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

        </section><!-- End Clients Section --> --}}

        <!-- ======= Recent Blog Posts Section ======= -->
        <section id="recent-blog-posts" class="recent-blog-posts">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Berita</h2>
                    <p>Berita Terkini</p>
                </header>

                <div class="row">
                    @foreach ($news as $item)
                        <div class="col-lg-4">
                            <div class="post-box">
                                <div class="post-img"><img src="{{ $item['image'] }}" class="img-fluid" alt="">
                                </div>
                                <span class="post-date">{{ date('D, d-m-Y', strtotime($item['created_at'])) }}</span>
                                <h3 class="post-title"> {{ $item['title'] }}</h3>
                                <a href="{{ route('blog-single', ['id' => $item['id']]) }}"
                                    class="readmore stretched-link mt-auto"><span>Baca
                                        Selengkapnya</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section><!-- End Recent Blog Posts Section -->
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Kontak</h2>
                    <p>Kontak Kami</p>
                </header>

                <div class="row gy-4">

                    <div class="col-lg-6">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Alamat</h3>
                                    <p>Gedung JTI,<br>Politeknik Negeri Jember</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email</h3>
                                    <p>cdcpolije@gmail.com<br>jtinova@police.ac.id</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <h3>Dikembangkan Oleh :</h3>
                                    <img style="width: 100px;" src="{{ asset('/') }}assets/img/jtinova.png"
                                        alt="">
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="col-lg-6">
                        <form action="{{ route('asking') }}" method="post">
                            @method('post')
                            @csrf
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Nama"
                                        required>
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Email"
                                        required>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subjek" placeholder="Subjek"
                                        required>
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="questions" rows="6" placeholder="Pesan" required></textarea>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-primary" style="text-align: start"
                                        type="submit">Kirim</button>
                                </div>
                            </div>
                        </form>
                        <div class="error-message">
                            @if ($errors->any())
                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                    <div class="text-white">{{ $errors }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Contact Section -->

        <section id="now" class="features">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>PENGEMBANG</h2>

                </header>

                <div class="row">



                    <div class="col-lg-12 mt-12 mt-lg-0 ">
                        <div class="row align-self-center gy-4">

                            <div class="col-6" data-aos="zoom-out" data-aos-delay="300">
                                <div class="feature-box d-flex align-items-center">
                                    <a
                                        href="https://www.linkedin.com/in/achmad-fawaid?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">
                                        <i class="bi bi-linkedin"></i></a>
                                    <div class="member-info">
                                        <h3>Achmad Fawaid</h3>
                                        <span>Mobile Developer</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6" data-aos="zoom-out" data-aos-delay="300">
                                <div class="feature-box d-flex align-items-center">
                                    <a
                                        href="https://www.linkedin.com/in/mohammad-tajut-zam-zami-645b54221?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">
                                        <i class="bi bi-linkedin"></i></a>
                                    <div class="member-info">
                                        <h3>Mohammad Tajut Zam Zami</h3>
                                        <span>Backend Developer</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6" data-aos="zoom-out" data-aos-delay="300">
                                <div class="feature-box d-flex align-items-center">
                                    <a
                                        href="https://www.linkedin.com/in/zhaqianroufa?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">
                                        <i class="bi bi-linkedin"></i></a>
                                    <div class="member-info">
                                        <h3>Zhaqian Rouf Alfauzi</h3>
                                        <span>UI/UX, Frontend Web Developer</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6" data-aos="zoom-out" data-aos-delay="300">
                                <div class="feature-box d-flex align-items-center">
                                    <a
                                        href="https://www.linkedin.com/in/shilmia-madina-3544a4277?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">
                                        <i class="bi bi-linkedin"></i></a>
                                    <div class="member-info">
                                        <h3>Shilmia Madina</h3>
                                        <span>UI/UX</span>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div> <!-- / row -->
            </div>

        </section>

    </main><!-- End #main -->
@endsection
