@extends('layouts.app')


@section('content')

    <style>
        table tbody tr td img{
            height: 100px;
        }
    </style>

    <div class="container-fluid">


        <div class="mt-4">
            <div class="col p-0">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-journal-bookmark-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8z" />
                                        <path
                                            d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                                        <path
                                            d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                                    </svg></i></a>
                            </li>

                            <li class="breadcrumb-item active" aria-current="page">Lowongan Mitra</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-body p-0">
                <div class="row ps-3">
                    <button class="btn btn-outline-primary btn-sm mb-3 w-auto m-3 " data-bs-toggle="modal"
                        data-bs-target="#my-modal"> <i class="fas fa-plus"></i>Tambah
                        Lowongan</button>
                </div>
            </div>
        </div> --}}

        <div class="table-responsive card p-2">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Perusahaan</th>
                        <th>Posisi</th>
                        <th>Deskripsi</th>
                        <th>Poster</th>
                        <th>Tautan</th>

                        <th>Kadaluwarsa</th>
                        <th>Diunggah</th>
                        <th>Bukti Pembayaran</th>
                        <th>Perizinan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['company'] }}</td>
                            <td>{{ $item['position'] }}</td>
                            <td>{{ $item['description'] }}</td>
                            <td>
                                <img src="{{ $item['image'] }}" alt="" style="height: 100px; "
                                    onerror="this.onerror=null;this.src='{{ asset('/') }}assets/images/nullsquare.jpg'">
                            </td>

                            <td style="text-align: center"><a href="{{ $item['link_apply'] }}" target="_blank"
                                    rel="noopener noreferrer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-folder-symlink-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3M2.19 3c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293L7.586 3H2.19m9.608 5.271-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742" />
                                    </svg></a></td>

                            <td>{{ \Carbon\Carbon::parse($item['expired'])->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item['post_at'])->format('Y-m-d') }}</td>
                            <td><img src="{{ $item['bukti'] }}" alt="bukti pembayaran"></td>
                            <td style="text-align: center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href=""><button type="button"
                                            class="btn btn-success me-2 mb-2">Setujui</button></a>
                                    <a href=""> <button type="button" class="btn btn-danger">Tolak</button></a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>





    <x-modal-small id="detail-user" footer="footer" title="title" body="body">
        <x-slot name="title">Detail Pengunggah <span id="level-uploader"></span></x-slot>
        <x-slot name="body">
            <div></div>
            <img id="img-uploader" class="rounded-circle mb-3  shadow-4-strong" alt="image-uploader" />

            <div class="row mb-3">
                <label for="input35" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input readonly type="text" class="form-control" id="email-user" placeholder="Enter Your Name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="input36" class="col-sm-3 col-form-label">Nama Lengkap</label>
                <div class="col-sm-9">
                    <input readonly type="text" class="form-control" id="fullname-user" placeholder="Phone No">
                </div>
            </div>
            <div class="row mb-3">
                <label for="input37" class="col-sm-3 col-form-label">NIM / NPWP</label>
                <div class="col-sm-9">
                    <input readonly type="email" class="form-control" id="nim-user" placeholder="Email Address">
                </div>
            </div>
            <div class="row mb-3">
                <label for="input37" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <input readonly type="email" class="form-control" id="address-user" placeholder="Email Address">
                </div>
            </div>
            <div class="row mb-3">
                <label for="input37" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-9">
                    <input readonly type="email" class="form-control" id="gender-user" placeholder="Email Address">
                </div>
            </div>
        </x-slot>
    </x-modal-small>
@endsection
