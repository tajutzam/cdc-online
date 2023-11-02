@extends('layouts.auth')
@section('content')
    <div style="background: linear-gradient(to right, #0771BD, #2EA3F8); height:1000px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <div class="card mt-5 rounded-4">
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                <div class="text-white">{{ $errors->first() }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            <h4 class="mb-0">
                                Atur Ulang Kata Sandi
                            </h4>
                            <p class="pt-0">
                                Masukkan Sandi Baru Anda
                            </p>
                            <form action="{{ route('forgotpassword-put', ['token' => $token]) }}" method="POST">
                                @method('put')
                                <div class="mb-3">
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0" name="password"
                                            id="inputChoosePassword" value="" placeholder="Sandi"
                                            style="background-color: #f1f1f3;">
                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                class='bx bx-hide'></i></a>
                                        <input type="text" name="email" value="{{ $email }}" hidden>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0" name="konfirmasipassword"
                                            id="inputChoosePassword" value="" placeholder="Konfirmasi Sandi"
                                            style="background-color: #f1f1f3;">
                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                class='bx bx-hide'></i></a>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn rounded-3"
                                        style="background: linear-gradient(to right, #0771BD, #2EA3F8); color: white; font-weight: bold;">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')

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
