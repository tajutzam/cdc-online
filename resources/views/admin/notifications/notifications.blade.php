@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="mt-4">
                <div class="col p-0">
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('notifications') }}">Notifikasi</a>
                                <li class="breadcrumb-item active" aria-current="page">Kuesioner</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <div class="row ps-3">

                        <button class="btn btn-success btn-sm mb-3 w-auto m-3"> <i class="fa fa-paper-plane pb-1"
                                style="color: white"></i><span class="text-decoration-none">Kirim Semua</button>

                    </div>
                </div>
            </div>
            <div class="row-12 p-0">
                <div class="table-responsive card p-2">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Foto</th>
                                <th>Status Akun</th>
                                <th>Kemajuan</th>
                                <th>Level Quisioner</th>
                                {{-- <th>Detail Kuesioner</th> --}}
                                <th>Notifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: start">{{ $item['nim'] }}</td style="text-align: start">
                                    <td style="text-align: start">{{ $item['fullname'] }}</td style="text-align: start">
                                    <td style="text-align: start" style="text-align: start">
                                        {{ $item['prodi']['nama_prodi'] ?? '-' }}</td>
                                    <td><img style="height: 100px" src="{{ $item['foto'] }}" alt="foto alumni"></td>
                                    <td>
                                        @if ($item['account_status'])
                                            <i class="fa-solid fa-circle-check" style="color: #005eff;"></i>
                                        @else
                                            <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="progress" role="progressbar" aria-label="Success example"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-success" style="width: 25%">
                                                {{ $item['presentasi'] }}/9
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-facebook">
                                            @if (isset($item['quisioner_level'][0]))
                                                {{ $item['quisioner_level'][0]['level'] }} Bulan
                                            @else
                                                0 Bulan
                                            @endif
                                        </p>
                                    </td>
                                    {{-- <td><button type="button" class="btn btn-warning btn-sm">Detail</button>
                            </td> --}}
                                    <td>
                                        <a href="">
                                            <i class="fa-solid fa-paper-plane" style="color: #005eff;"></i><span
                                                class="text-decoration-none"> </span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </tabel>
                </div>
            </div>
        </div>
    @endsection
