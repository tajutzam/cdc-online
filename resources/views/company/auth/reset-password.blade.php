@extends('layouts-company.auth')
@section('content')
    <div class="wrapper">
        <div class="authentication-reset-password d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="p-4">
                                    <div class="m-0 text-center">
                                        <img src="{{ asset('/') }}assets/images/logoblack.png" width="100"
                                            alt="" />
                                    </div>
                                    <div class="text-start mb-4">
                                        <h5 class="">Ganti Password</h5>
                                        <p class="mb-0">Masukkan Password Baru Anda</p>
                                    </div>
                                    <div class="mb-3 mt-4">
                                        <label class="form-label">Password Baru</label>
                                        <input type="text" class="form-control" placeholder="Enter new password" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="text" class="form-control" placeholder="Confirm password" />
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-primary">Ubah Password</button> <a
                                            href="{{ route('login-company') }}" class="btn btn-light"><i
                                                class='bx bx-arrow-back mr-1'></i>Kembali Masuk</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
