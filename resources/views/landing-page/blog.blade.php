@extends('landing-page.layouts.app')
@section('content')
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="{{ route('/') }}" class="logo align-items-center">
                <img src="{{ asset('/') }}assets/img/logoblue.png" alt="">

            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="{{ route('/') }}">Home</a></li>
                    <li><a href="{{ route('/') }}">Tentang</a></li>
                    <li><a href="{{ route('/') }}">Fitur</a></li>
                    <li><a href="{{ route('blog') }}">Berita</a></li>
                    <li><a href="{{ route('/') }}">Kontak</a></li>
                    <li><a class="getstarted scrollto" href="{{ route('/') }}">Unduh Sekarang</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="{{ route('/') }}">Home</a></li>
                    <li>Berita</li>
                </ol>
                <h2>Berita</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-8 entries">

                        <article class="entry">

                            <div class="entry-img">
                                <img src="{{ asset('/') }}assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                            </div>

                            <h2 class="entry-title">
                                <a href="{{ route('blog-single') }}">Dolorum optio tempore voluptas dignissimos cumque fuga
                                    qui
                                    quibusdam quia</a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                            href="{{ route('blog-single') }}">Admin</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                            href="{{ route('blog-single') }}"><time datetime="2020-01-01">Jan 1,
                                                2020</time></a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                            href="{{ route('blog-single') }}">12 Comments</a></li>
                                </ul>
                            </div>

                            <div class="entry-content">
                                <p>
                                    Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi
                                    praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                                    Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta.
                                    Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda
                                    perferendis dolore.
                                </p>
                                <div class="read-more">
                                    <a href="{{ route('blog-single') }}">Selengkapnya</a>
                                </div>
                            </div>

                        </article><!-- End blog entry -->

                        <div class="blog-pagination">
                            <ul class="justify-content-center">
                                <li><a href="#">1</a></li>
                                <li class="active"><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                            </ul>
                        </div>

                    </div><!-- End blog entries list -->

                    <div class="col-lg-4">

                        <div class="sidebar">

                            <h3 class="sidebar-title">Berita Terkini</h3>
                            <div class="sidebar-item recent-posts">
                                <div class="post-item clearfix">
                                    <img src="{{ asset('/') }}assets/img/blog/blog-recent-1.jpg" alt="">
                                    <h4><a href="{{ route('blog-single') }}">Nihil blanditiis at in nihil autem</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="{{ asset('/') }}assets/img/blog/blog-recent-2.jpg" alt="">
                                    <h4><a href="{{ route('blog-single') }}">Quidem autem et impedit</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="{{ asset('/') }}assets/img/blog/blog-recent-3.jpg" alt="">
                                    <h4><a href="{{ route('blog-single') }}">Id quia et et ut maxime similique occaecati
                                            ut</a>
                                    </h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="{{ asset('/') }}assets/img/blog/blog-recent-4.jpg" alt="">
                                    <h4><a href="{{ route('blog-single') }}">Laborum corporis quo dara net para</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                                <div class="post-item clearfix">
                                    <img src="{{ asset('/') }}assets/img/blog/blog-recent-5.jpg" alt="">
                                    <h4><a href="{{ route('blog-single') }}">Et dolores corrupti quae illo quod dolor</a>
                                    </h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>

                            </div><!-- End sidebar recent posts-->

                            {{-- <h3 class="sidebar-title">Tags</h3>
                            <div class="sidebar-item tags">
                                <ul>
                                    <li><a href="#">App</a></li>
                                    <li><a href="#">IT</a></li>
                                    <li><a href="#">Business</a></li>
                                    <li><a href="#">Mac</a></li>
                                    <li><a href="#">Design</a></li>
                                    <li><a href="#">Office</a></li>
                                    <li><a href="#">Creative</a></li>
                                    <li><a href="#">Studio</a></li>
                                    <li><a href="#">Smart</a></li>
                                    <li><a href="#">Tips</a></li>
                                    <li><a href="#">Marketing</a></li>
                                </ul>
                            </div><!-- End sidebar tags--> --}}

                        </div><!-- End sidebar -->

                    </div><!-- End blog sidebar -->

                </div>

            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->
@endsection
