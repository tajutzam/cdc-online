@extends('layouts.auth')
@section('content')
    <div style="background: linear-gradient(to right, #0771BD, #2EA3F8); height:1000px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <div class="card mt-5 rounded-4">
                        <div class="card-body">
                            <h4 class="mb-0">
                                Atur Ulang Kata Sandi
                            </h4>
                            <p class="pt-0">
                                Masukkan Sandi Baru Anda
                            </p>
                            <form id="resetPasswordForm">
                                <div class="mb-3">
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0" name="password"
                                            id="inputChoosePassword" value="" placeholder="Sandi"
                                            style="background-color: #f1f1f3;">
                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                class='bx bx-hide'></i></a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0" name="password"
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
