@extends('layouts.app')

@section('content')
    <div style="padding-left: 2.5%">
        @if ($errors->any())
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                <div class="text-white">{{ $errors->first() }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row gap-4">
            <div class="card radius-10 col-lg-3 col-md-4 col-sm-12 ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Alumni Yang Mengisi Quisioner</p>
                            {{-- <h4 class="my-1">{{ $data['count']['active'] }}</h4> --}}
                        </div>
                        <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-user-badge'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card radius-10 col-lg-3 col-md-4 col-sm-12 ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Alumni Yang Belum Mengisi Quisioner</p>
                            {{-- <h4 class="my-1">{{ $data['count']['nonactive'] }}</h4> --}}
                        </div>
                        <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-user-account'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <div class="">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i><i><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                                            <path
                                                d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z" />
                                        </svg></i></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Referensi Alumni</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="row -md-6">
                <div class="card" style="padding: 0%;">
                    <div class="row p-2 justify-content-between">
                        <div class="col">
                            <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="">Perbarui</button>
                        </div>
                        <div class="col-3">
                            <select class="form-select form-select-sm" id="filter-user" aria-label="Small select example">
                                <option value="filter">Filter</option>
                                <option value="1">Terverifikasi</option>
                                <option value="0">Belum Terferivikasi</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-md-6">
                <div class="card row align-items-start py-2 table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Email</th>
                                <th>Tahun Lulus</th>
                                <th>Tahun Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data['alumni'] as $item) --}}
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['nim'] }}</td>
                                    <td>{{ $item['nama_lengkap'] }}</td>
                                    <td>{{ $item['program_studi'] }}</td>
                                    <td>{{ $item['email'] }}</td>
                                    <td>{{ $item['tahun_lulus'] }}</td>
                                    <td>{{ $item['angkatan'] }}</td>

                                </tr>
                            @endforeach
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
