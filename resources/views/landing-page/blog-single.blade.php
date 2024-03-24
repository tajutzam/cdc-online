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
                      <li><a class="" href="{{ route('/') }}">Unduh Sekarang</a></li>
                  </ul>
                  <i class="bi bi-list mobile-nav-toggle"></i>
              </nav><!-- .navbar -->
          </div>
      </header>
      <section class="breadcrumbs">
          <div class="container">

              <ol>
                  <li><a href="{{ route('/') }}">Home</a></li>
                  <li><a href="{{ route('blog') }}">Berita</a></li>
                  <li>Detail Berita</li>
              </ol>
              <h2>Detail Berita</h2>

          </div>
      </section>


      <main id="main">

          <!-- ======= Breadcrumbs ======= -->
          <!-- End Breadcrumbs -->

          <!-- ======= Blog Single Section ======= -->
          <section id="blog" class="blog">
              <div class="container" data-aos="fade-up">

                  <div class="row">

                      <div class="col-lg-8 entries">

                          <article class="entry entry-single">

                              <div class="entry-img">
                                  <img src="{{ $blog['image'] }}" alt="" class="img-fluid"
                                      onerror="this.onerror=null;this.src='{{ asset('/') }}assets/images/nullrectangle.jpg';">
                              </div>

                              <h2 class="entry-title">
                                  <a href="{{ route('blog-single', ['id' => $blog['id']]) }}">{{ $blog['title'] }}</a>
                              </h2>
                              {{-- @dd($blog) --}}
                              <div class="entry-meta">
                                  <ul>
                                      <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                              href="{{ route('blog-single', ['id' => 1]) }}">{{ $blog['admin']['name'] }}</a>
                                      </li>
                                      <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                              href="{{ route('blog-single', ['id' => 1]) }}"><time
                                                  datetime="2020-01-01">Jan 1,
                                                  2020</time></a>
                                  </ul>
                              </div>

                              <div class="entry-content">
                                  {!! $blog['description'] !!}

                              </div>

                          </article><!-- End blog entry -->

                          <div class="blog-author d-flex align-items-center">
                              <img src="{{ asset('/') }}assets/images/user.jpg" class="rounded-circle float-left"
                                  alt="">
                              <div>
                                  <h4>{{ $blog['admin']['name'] }}</h4>
                                  <p>
                                      CDC (Career Develompent Center) Politeknik Negeri Jember
                                  </p>
                              </div>
                          </div><!-- End blog author bio -->


                      </div><!-- End blog entries list -->

                      <div class="col-lg-4">

                          <div class="sidebar">
                              <h3 class="sidebar-title">Berita Terkini</h3>
                              <div class="sidebar-item recent-posts">


                                  @foreach ($news as $item)
                                      <div class="post-item clearfix">
                                          <img src="{{ $item['image'] }}"
                                              alt=""onerror="this.onerror=null;this.src='{{ asset('/') }}assets/images/nullsquare.jpg';">
                                          <h4><a
                                                  href="{{ route('blog-single', ['id' => $item['id']]) }}">{{ $item['title'] }}</a>
                                          </h4>
                                          <time
                                              datetime="2020-01-01">{{ date('D, d-m-Y', strtotime($item['created_at'])) }}</time>
                                      </div>
                                  @endforeach

                              </div><!-- End sidebar recent posts-->
                          </div><!-- End sidebar -->

                      </div><!-- End blog sidebar -->

                  </div>

              </div>
          </section><!-- End Blog Single Section -->

      </main><!-- End #main -->
  @endsection
