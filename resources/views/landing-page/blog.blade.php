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

                        @foreach ($data as $item)
                            <article class="entry">

                                <div class="entry-img">
                                    <img src="{{ $item['image'] }}" alt="poster" class="img-fluid">
                                </div>

                                <h2 class="entry-title">
                                    <a href="{{ route('blog-single') }}">{{ $item['title'] }}</a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                href="{{ route('blog-single') }}">{{ $item['admin']['name'] }}</a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                href="{{ route('blog-single') }}"><time
                                                    datetime="2020-01-01">{{ date('D, d-m-Y', strtotime($item['created_at'])) }}
                                                </time></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="entry-content ">
                                    <span class="text-truncate">{!! $item['description'] !!}</span>

                                    <div class="read-more">
                                        <a href="{{ route('blog-single') }}">Selengkapnya</a>
                                    </div>
                                </div>
                            </article><!-- End blog entry -->
                        @endforeach

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
                                @foreach ($data as $item)
                                    <div class="post-item clearfix">
                                        <img src="{{ asset('/') }}assets/img/blog/blog-recent-1.jpg" alt="">
                                        <h4><a href="{{ route('blog-single') }}">{{ $item['title'] }}</a>
                                        </h4>
                                        <time
                                            datetime="2020-01-01">{{ date('D, d-m-Y', strtotime($item['created_at'])) }}</time>
                                    </div>
                                @endforeach
                            </div>
                            <!-- End sidebar recent posts-->

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
