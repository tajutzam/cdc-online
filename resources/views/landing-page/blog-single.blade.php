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
                                  <img src="{{ asset('/') }}assets/img/blog/blog-1.jpg" alt=""
                                      class="img-fluid">
                              </div>

                              <h2 class="entry-title">
                                  <a href="blog-single.html">Dolorum optio tempore voluptas dignissimos cumque fuga qui
                                      quibusdam quia</a>
                              </h2>

                              <div class="entry-meta">
                                  <ul>
                                      <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                              href="blog-single.html">Admin</a></li>
                                      <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                              href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a>
                                      </li>
                                      <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                              href="blog-single.html">12 Comments</a></li>
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

                                  <p>
                                      Sit repellat hic cupiditate hic ut nemo. Quis nihil sunt non reiciendis. Sequi in
                                      accusamus harum vel aspernatur. Excepturi numquam nihil cumque odio. Et voluptate
                                      cupiditate.
                                  </p>

                                  <p>
                                      Sed quo laboriosam qui architecto. Occaecati repellendus omnis dicta inventore
                                      tempore provident voluptas mollitia aliquid. Id repellendus quia. Asperiores nihil
                                      magni dicta est suscipit perspiciatis. Voluptate ex rerum assumenda dolores nihil
                                      quaerat.
                                      Dolor porro tempora et quibusdam voluptas. Beatae aut at ad qui tempore corrupti
                                      velit quisquam rerum. Omnis dolorum exercitationem harum qui qui blanditiis neque.
                                      Iusto autem itaque. Repudiandae hic quae aspernatur ea neque qui. Architecto
                                      voluptatem magni. Vel magnam quod et tempora deleniti error rerum nihil tempora.
                                  </p>

                                  <p>
                                      Officiis animi maxime nulla quo et harum eum quis a. Sit hic in qui quos fugit ut
                                      rerum atque. Optio provident dolores atque voluptatem rem excepturi molestiae qui.
                                      Voluptatem laborum omnis ullam quibusdam perspiciatis nulla nostrum. Voluptatum est
                                      libero eum nesciunt aliquid qui.
                                      Quia et suscipit non sequi. Maxime sed odit. Beatae nesciunt nesciunt accusamus quia
                                      aut ratione aspernatur dolor. Sint harum eveniet dicta exercitationem minima.
                                      Exercitationem omnis asperiores natus aperiam dolor consequatur id ex sed. Quibusdam
                                      rerum dolores sint consequatur quidem ea.
                                      Beatae minima sunt libero soluta sapiente in rem assumenda. Et qui odit voluptatem.
                                      Cum quibusdam voluptatem voluptatem accusamus mollitia aut atque aut.
                                  </p>
                                  <p>
                                      Alias quia non aliquid. Eos et ea velit. Voluptatem maxime enim omnis ipsa voluptas
                                      incidunt. Nulla sit eaque mollitia nisi asperiores est veniam.
                                  </p>

                              </div>

                          </article><!-- End blog entry -->

                          <div class="blog-author d-flex align-items-center">
                              <img src="{{ asset('/') }}assets/img/blog/blog-author.jpg"
                                  class="rounded-circle float-left" alt="">
                              <div>
                                  <h4>Admin</h4>
                                  <p>
                                      CDC (Career Develompent Center) Politeknik Negeri Jember
                                  </p>
                              </div>
                          </div><!-- End blog author bio -->

                          <div class="blog-comments">

                              <h4 class="comments-count">8 Komentar</h4>

                              <div id="comment-1" class="comment">
                                  <div class="d-flex">
                                      <div class="comment-img"><img src="{{ asset('/') }}assets/img/blog/comments-1.jpg"
                                              alt="">
                                      </div>
                                      <div>
                                          <h5><a href="">Georgia Reader</a> <a href="#" class="reply"></a>
                                          </h5>
                                          <time datetime="2020-01-01">01 Jan, 2020</time>
                                          <p>
                                              Et rerum totam nisi. Molestiae vel quam dolorum vel voluptatem et et. Est ad
                                              aut sapiente quis molestiae est qui cum soluta.
                                              Vero aut rerum vel. Rerum quos laboriosam placeat ex qui. Sint qui facilis
                                              et.
                                          </p>
                                      </div>
                                  </div>
                              </div><!-- End comment #1 -->

                              <div class="reply-form">
                                  <h4>Berikan Balasan</h4>
                                  <form action="">
                                      <div class="row">
                                          <div class="col-md-6 form-group">
                                              <input name="name" type="text" class="form-control"
                                                  placeholder="Nama Anda">
                                          </div>
                                          <div class="col-md-6 form-group">
                                              <input name="email" type="text" class="form-control" placeholder="Email">
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col form-group">
                                              <textarea name="comment" class="form-control" placeholder="Balasan Anda"></textarea>
                                          </div>
                                      </div>
                                      <button type="submit" class="btn btn-primary">Kirim</button>

                                  </form>

                              </div>

                          </div><!-- End blog comments -->

                      </div><!-- End blog entries list -->

                      <div class="col-lg-4">

                          <div class="sidebar">
                              <h3 class="sidebar-title">Berita Terkini</h3>
                              <div class="sidebar-item recent-posts">
                                  <div class="post-item clearfix">
                                      <img src="{{ asset('/') }}assets/img/blog/blog-recent-1.jpg" alt="">
                                      <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                                      <time datetime="2020-01-01">Jan 1, 2020</time>
                                  </div>

                                  <div class="post-item clearfix">
                                      <img src="{{ asset('/') }}assets/img/blog/blog-recent-2.jpg" alt="">
                                      <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
                                      <time datetime="2020-01-01">Jan 1, 2020</time>
                                  </div>

                                  <div class="post-item clearfix">
                                      <img src="{{ asset('/') }}assets/img/blog/blog-recent-3.jpg" alt="">
                                      <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a>
                                      </h4>
                                      <time datetime="2020-01-01">Jan 1, 2020</time>
                                  </div>

                                  <div class="post-item clearfix">
                                      <img src="{{ asset('/') }}assets/img/blog/blog-recent-4.jpg" alt="">
                                      <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
                                      <time datetime="2020-01-01">Jan 1, 2020</time>
                                  </div>

                                  <div class="post-item clearfix">
                                      <img src="{{ asset('/') }}assets/img/blog/blog-recent-5.jpg" alt="">
                                      <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
                                      <time datetime="2020-01-01">Jan 1, 2020</time>
                                  </div>

                              </div><!-- End sidebar recent posts-->
                          </div><!-- End sidebar -->

                      </div><!-- End blog sidebar -->

                  </div>

              </div>
          </section><!-- End Blog Single Section -->

      </main><!-- End #main -->
  @endsection
