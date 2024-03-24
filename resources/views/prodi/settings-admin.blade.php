@extends('prodi-layouts.app')

@section('content')
    <!--breadcrumb-->

    <!--end breadcrumb-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0"style="background-color:white">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Pengaturan Akun</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4 text-center">
                <div class="card">
                    <div class="card-body" style="padding: 0% ; margin-top: 5%; margin-bottom: 2%">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ asset('/') }}assets/images/admin.png" class="logo-text"
                                style="width: 110px; margin:0%">
                            <div style="width: 100%; height: 1px; background-color: #000; opacity: 50%; margin:2%;">
                            </div>
                            <h5 style="text-align: center; margin: 0%">{{ auth('prodi')->user()->prodi->nama_prodi }}</h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-10" style="height: 60px">
                <div class="card" style="background-color: #007bff; border-radius: 10px 10px 0 0;">
                    <div class="card-body p-2">
                        <h3 style="padding-inline-start: 10px; margin: 0; color: white; font-weight: bold; height:0%;">
                            Edit</h3>
                    </div>
                </div>
            </div>

        </div>


        <div class="row justify-content-center">
            <div class="col-sm-10">
                @if ($errors->any())
                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                        <div class="text-white">{{ $errors->first() }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <form action="{{ route('settings-admin-prodi-put', ['id' => 1]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ auth('prodi')->user()->name }} " />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="email" class="form-control"
                                        value="{{ auth('prodi')->user()->email }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">NPWP</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="npwp" class="form-control" name="npwp"
                                        value="{{ auth('prodi')->user()->nik }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Alamat</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="address"
                                        value="{{ auth('prodi')->user()->address }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Password</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="password" />
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary text-end    ">
                                    <input type="submit" class="btn btn-primary px-4" value="Simpan" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
