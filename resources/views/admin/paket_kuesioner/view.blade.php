@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-database" viewBox="0 0 16 16">
                                        <path
                                            d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Detail Kuesioner</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="row justify-content-start">
                        <div class="col-2 text-start">
                            <span style="font-weight: bold; font-size: 15px">
                                Judul
                            </span>
                            <br>
                            <span style="font-weight: bold; font-size: 15px">
                                Tipe
                            </span>
                        </div>
                        <div class="col-1 text-center p-0">
                            <span style="font-weight: bold; font-size: 15px">
                                :
                            </span>
                            <br>
                            <span style="font-weight: bold; font-size: 15px">
                                :
                            </span>
                        </div>
                        <div class="col-9 text-start">
                            <span style="font-weight: bold; font-size: 15px">
                                Program Kuesioner Mahasiswa Semester Akhir
                            </span>
                            <br>
                            <span style="font-weight: bold; font-size: 15px">
                                Tracer Study
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <div class="btn btn-success">
                                Tambah Pertanyaan
                            </div>
                            <div class="btn btn-warning">
                                Test Form
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 pe-0 me-0">
                                <strong>1.Apakah kamu seorang Kapiten ? <span style="color: red">*</span></strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <div class="badge badge-success p-2 mt-1">Input Angka</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end">
                                <div class="btn btn-info">
                                    Duplikat
                                </div>
                                <div class="btn btn-warning">
                                    Edit
                                </div>
                                <div class="btn btn-danger">
                                    Hapus
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
