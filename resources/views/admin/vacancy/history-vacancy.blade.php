@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

                <div class="">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Lowongan</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <div class="row">

                <div class="col-md-6">
                    <h2>Lowongan Aktif</h2>
                    <div class="table-responsive card p-2">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengunggah</th>
                                    <th>Perusahaan</th>
                                    <th>Posisi</th>
                                    <th>Deskripsi</th>
                                    <th>Poster</th>
                                    <th>Tautan</th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div>
                    <x-modal id="detail-user" footer="footer" title="title" body="body"> <x-slot name="title">Detail
                            Pengunggah <span id="level-uploader"></span></x-slot>
                        <x-slot name="body">
                            <div></div>
                            <img id="img-uploader" class="rounded-circle mb-3  shadow-4-strong" alt="image-uploader" />

                            <div class="row mb-3">
                                <label for="input35" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input readonly type="text" class="form-control" id="email-user"
                                        placeholder="Enter Your Name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input36" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input readonly type="text" class="form-control" id="fullname-user"
                                        placeholder="Phone No">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">NIM / NPWP</label>
                                <div class="col-sm-9">
                                    <input readonly type="email" class="form-control" id="nim-user"
                                        placeholder="Email Address">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input readonly type="email" class="form-control" id="address-user"
                                        placeholder="Email Address">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <input readonly type="email" class="form-control" id="gender-user"
                                        placeholder="Email Address">
                                </div>
                            </div>
                        </x-slot>
                    </x-modal>
                </div>
                <div class="col-md-6">
                    <h2>Lowongan Tidak Aktif</h2>
                    <div class="table-responsive card p-2">
                        <table id="mytable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengunggah</th>
                                    <th>Perusahaan</th>
                                    <th>Posisi</th>
                                    <th>Deskripsi</th>
                                    <th>Poster</th>
                                    <th>Tautan</th>

                                </tr>
                            </thead>
                            <tbody></tbody>

                        </table>
                    </div>
                    <x-modal id="detail-user" footer="footer" title="title" body="body">
                        <x-slot name="title">Detail Pengunggah <span id="level-uploader"></span></x-slot>



                        <x-slot name="body">
                            <div></div>
                            <img id="img-uploader" class="rounded-circle mb-3  shadow-4-strong" alt="image-uploader" />

                            <div class="row mb-3">
                                <label for="input35" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input readonly type="text" class="form-control" id="email-user"
                                        placeholder="Enter Your Name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input36" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input readonly type="text" class="form-control" id="fullname-user"
                                        placeholder="Phone No">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">NIM / NPWP</label>
                                <div class="col-sm-9">
                                    <input readonly type="email" class="form-control" id="nim-user"
                                        placeholder="Email Address">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input readonly type="email" class="form-control" id="address-user"
                                        placeholder="Email Address">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="input37" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <input readonly type="email" class="form-control" id="gender-user"
                                        placeholder="Email Address">
                                </div>
                            </div>
                        </x-slot>
                    </x-modal>
                </div>
            </div>
        </div>
    @endsection
