@extends('layouts.app')

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
                <div class="card">
                    <form action="{{ route('settings-admin-put') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control"
                                        value="{{ Auth::guard('admin')->user()->name }}" name="name" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control"
                                        value="{{ Auth::guard('admin')->user()->email }}" name="email" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">NPWP</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control"
                                        value="{{ Auth::guard('admin')->user()->npwp }}" name="npwp" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Alamat</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control"
                                        value="{{ Auth::guard('admin')->user()->alamat }}" name="address" />
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
