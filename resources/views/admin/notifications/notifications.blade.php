@extends('layouts.app')


@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

        <div class="">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('notifications') }}">Notifikasi</a>
                    <li class="breadcrumb-item active" aria-current="page">Kuesioner</li>
                </ol>
            </nav>
        </div>
    </div>
    <notif-quisioner>
        {{-- <div class="card p-3">
            Notifikasi Kuesioner
        </div> --}}
        <div class="table-responsive">

            <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Kemajuan</th>
                        <th>Tingkat</th>
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
                                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success" style="width: 25%">{{ $item['presentasi'] }}/9
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-facebook">{{ $item['status_quisioner'] }}</p>
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

            </table>
        </div>
    </notif-quisioner>

    {{-- <notif-berita>
        <div class="card p-3">
            Notifikasi Berita
        </div>
    </notif-berita>
    <notif-verifikasi>
        <div class="card p-3">
            Notifikasi Verifikasi Account
        </div>
    </notif-verifikasi> --}}
@endsection
