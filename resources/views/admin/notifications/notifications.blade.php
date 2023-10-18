@extends('layouts.app')


@section('content')
    <notif-quisioner>
        <div class="card p-3">
            Notifikasi Quisioner
        </div>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nim</th>
                        <th>Nama Prodi</th>
                        <th>Nama Alumni</th>
                        <th>Foto Alumni</th>
                        <th>Status Akun</th>
                        <th>Kemajuan Quisioner</th>
                        <th>Tingkat Quisioner</th>
                        <th>Detail Quisioner</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['nim'] }}</td>
                            <td>{{ $item['prodi']['nama_prodi'] ?? '-' }}</td>
                            <td>{{ $item['fullname'] }}</td>
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
                            <td><button type="button" class="btn btn-warning btn-sm">Detail</button>
                            </td>
                            <td>
                                <a href="#">
                                    <i class="fa-solid fa-paper-plane" style="color: #005eff;"></i><span
                                        class="text-decoration-none"> Kirim notif</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nim</th>
                        <th>Nama Prodi</th>
                        <th>Nama Alumni</th>
                        <th>Foto Alumni</th>
                        <th>Status Akun</th>
                        <th>Kemajuan Quisioner</th>
                        <th>Tingkatan Quisioner</th>
                        <th>Detail Quisioner</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </notif-quisioner>

    <notif-berita>
        <div class="card p-3">
            Notifikasi Berita
        </div>
    </notif-berita>
    <notif-verifikasi>
        <div class="card p-3">
            Notifikasi Verifikasi Account
        </div>
    </notif-verifikasi>
@endsection
