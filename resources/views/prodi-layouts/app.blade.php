<!doctype html>
<html lang="en">


<!-- Mirrored from codervent.com/syndron/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jul 2023 03:54:59 GMT -->
@include('prodi-layouts.header')

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('prodi-layouts.sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('prodi-layouts.head')
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer" style=" z-index:999;">
            <p class="mb-0">CDC (Career Development & Counseling) Politeknik Negeri Jember © 2023. All right reserved.
            </p>
        </footer>
    </div>
    <!--end wrapper-->

    <!--end switcher-->
    <!-- Bootstrap JS -->
    @include('prodi-layouts.footer')
    @include('sweetalert::alert')
</body>


<!-- Mirrored from codervent.com/syndron/demo/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 29 Jul 2023 03:55:08 GMT -->

</html>
