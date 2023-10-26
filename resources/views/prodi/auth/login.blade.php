@extends('layouts.auth')
@section('content')
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">

                    <div
                        class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                        <div class="container shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            <div class="card-body  text-center">
                                <img src="{{ asset('/') }}assets/images/login-images/login-cover.svg" width="675"
                                    alt="" />
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                        <div class="container rounded-0 m-3 shadow-none bg-transparent mb-0">
                            <div class="card-body p-sm-5">
                                <div class="">
                                    <div class="mb-3 text-center">
                                        <img src="{{ asset('/') }}assets/images/logoblacklogin.png" width="100"
                                            alt="" />
                                    </div>
                                    <div class="text-center mb-4">
                                        <h3 class="" style="font-weight: bold">Masuk Admin</h3>
                                        <p class="mb-0">Masuk ke akun Anda</p>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" method="POST" action="{{ route('prodi-login') }}">
                                            @csrf
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="inputEmailAddress"
                                                    placeholder="Email Anda" name="email">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" name="password"
                                                        id="inputChoosePassword" value=""
                                                        placeholder="Masukkan Password">
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-end">

                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn rounded-5"
                                                        style="background: linear-gradient(to right, #0771BD, #2EA3F8); color: white; font-weight: bold;">Masuk</button>
                                                </div>
                                            </div>
                                            <div class="col-12">

                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--end row-->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
@endsection
