@extends('layouts.app')

@section('content')

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card ">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Alumni Yang Mengisi Quisioner</p>
                                    <h4 class="my-1">10</h4>
                                </div>
                                <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-pencil'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total Alumni Yang Belum Mengisi Quisioner</p>
                                    <h4 class="my-1">20</h4>
                                </div>
                                <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-pencil'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                                            <path
                                                d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z" />
                                        </svg>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Kuesioner</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Tahun
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="">2022</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="">2023</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="">2024</a></li>
                                </ul>
                            </div>

                            <div class="btn-group" role="group" aria-label="Basic mixed styles example"
                                style="padding: 1%">
                                <button type="button" class="btn btn-danger">
                                    <a href="?bulan=0" style="color: white">0 Bulan</a>
                                </button>
                                <button type="button" class="btn btn-warning">
                                    <a href="?bulan=6" style="color: white">6 Bulan</a>
                                </button>
                                <button type="button" class="btn btn-success">
                                    <a href="?bulan=12" style="color: white">12 Bulan</a>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example"
                                style="padding: 1%">
                                <button type="button" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z" />
                                    </svg> Unduh
                                </button>
                                <button type="button" class="btn btn-outline-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                                        <path
                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z" />
                                    </svg> Excel
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                        <path
                                            d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707V11.5z" />
                                        <path
                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                    </svg> Upload
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="table table-striped table-bordered table-hover table-condensed"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Program Studi</th>
                                            <th>Email</th>
                                            <th>Foto</th>
                                            <th>Tahun Lulus</th>
                                            <th>Tahun Masuk</th>
                                            <th>Status</th>
                                            <th style="text-align: center">Detail</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item['fullname'] }}</td>
                                                <td>{{ $item['prodi']['nama_prodi'] }}</td>
                                                <td>{{ $item['email'] }}</td>
                                                <td><img style="max-height: 50px" class="img-fluid"
                                                        src="{{ $item['foto'] }}" alt="foto_user"></td>
                                                <td>{{ $item['tahun_masuk'] }}</td>
                                                <td>{{ $item['tahun_lulus'] }}</td>
                                                <td class="text-center">
                                                    @if ($item['account_status'])
                                                        <i class="fa-solid fa-circle-check" style="color: #005eff;"></i>
                                                    @else
                                                        <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="" dropdown px-3" class="text-center">
                                                        <a class="d-flex align-items-center nav-link  gap-3 dropdown-toggle-nocaret"
                                                            href="#" role="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="btn btn-success">2/9</button>
                                                                <button type="button"
                                                                    class="btn btn-success dropdown-toggle dropdown-toggle-split"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false"></button>
                                                            </div>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item d-flex align-items-center"
                                                                    href="quisioner/detail/{{ $item['id'] }}"><i></i><span>1</span></a>
                                                            </li>
                                                            <li>
                                                                <div class="dropdown-divider mb-0"></div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection