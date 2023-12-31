@extends('layouts-company.auth')
@section('content')
    <div class="wrapper">
        <div class="section-authentication-cover">
            <div class="">
                <div class="row g-0">

                    <div
                        class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">

                        <div class="container shadow-none bg-transparent shadow-none rounded-0 mb-0">
                            
                            <div class="card-body  text-center">
                                <img src="{{ asset('/') }}assets/images/login-images/register-cover.svg" width="675"
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
                                        <h3 class="" style="font-weight: bold">Daftar Perusahaan</h3>
                                        <p class="mb-0">Masukkan Data yang Sesuai</p>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                            <div class="text-white">{{ $errors->first() }}</div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <div class="form-body">
                                        <form class="row g-3" method="POST" action="{{ route('mitra-register') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('post')
                                            <div class="col-12">
                                                <label for="inputNama" class="form-label">Nama Perusahaan</label>
                                                <input type="text" class="form-control" id="inputNama"
                                                    placeholder="Masukkan Nama Perusahaan " name="name">
                                            </div>

                                            <div class="col-12">
                                                <label for="inputNIB" class="form-label">NIB (Nomor Induk Berusaha)</label>
                                                <input type="text" class="form-control" id="inputNIB"
                                                    placeholder="Masukkan Nomor Induk Berusaha " name="nib">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputSuratIzin" class="form-label">Surat Izin Usaha</label>
                                                <input type="file" class="form-control" id="inputSuratIzin"
                                                    placeholder="" name="business_license" accept=".pdf">
                                                <span class="mt-2 " style="color: red"><i>Upload File Berupa .pdf</i></span>

                                            </div>
                                            <div class="col-12">
                                                <label for="inputLogo" class="form-label">Logo Perusahaan</label>
                                                <input type="file" class="form-control" id="inputLogo" placeholder=""
                                                    name="logo" accept=".jpg, .png">

                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddres" class="form-label">Alamat Perusahaan</label>
                                                <input type="text" class="form-control" id="inputAddres"
                                                    placeholder="Masukkan Alamat " name="address">
                                            </div>
                                            <div class="col-12">
                                                <label for="phoneNumber" class="form-label">Nomor Telepon</label>
                                                <input type="number" class="form-control" id="phoneNumber"
                                                    placeholder="Masukkan Nomor Hp " name="phone">
                                            </div>

                                            <div class="col-12">
                                                <label for="inputEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="inputEmail"
                                                    placeholder="Masukkan Email" name="email">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" name="password"
                                                        id="inputChoosePassword"
                                                        placeholder="Masukkan Password Perusahaan ">
                                                    <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-end">

                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn rounded-5"
                                                        style="background: linear-gradient(to right, #0771BD, #2EA3F8); color: white; font-weight: bold;">Daftar</button>
                                                </div>
                                            </div>
                                            <div class="col-12">

                                            </div>
                                            <div class="text-center mt-3">
                                                <p>Sudah mempunyai akun? <a href="{{ route('login-company') }}">Masuk</a>
                                                </p>
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
