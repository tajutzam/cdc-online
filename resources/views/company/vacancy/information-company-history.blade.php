@extends('layouts-company.app')

@section('content')
    <style>
        table tbody tr td img {
            height: 100px;
        }
    </style>
    <div class="container-fluid">

        <div class="mt-4">
            <div class="col p-0">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                            <li class="breadcrumb-item"><a href=""><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" class="bi bi-easel2-fill"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8.447.276a.5.5 0 0 0-.894 0L7.19 1H2.5A1.5 1.5 0 0 0 1 2.5V10h14V2.5A1.5 1.5 0 0 0 13.5 1H8.809z" />
                                        <path fill-rule="evenodd"
                                            d="M.5 11a.5.5 0 0 0 0 1h2.86l-.845 3.379a.5.5 0 0 0 .97.242L3.89 14h8.22l.405 1.621a.5.5 0 0 0 .97-.242L12.64 12h2.86a.5.5 0 0 0 0-1zm3.64 2 .25-1h7.22l.25 1z" />
                                    </svg></i></a>
                            </li>

                            <li class="breadcrumb-item active" aria-current="page">Riwayat Informasi</li>
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

                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Poster</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['description'] }}</td>
                            <td>
                                <img src="{{ $item['poster'] }}" alt="" style="height: 100px; "
                                    onerror="this.onerror=null;this.src='{{ asset('/') }}assets/images/nullsquare.jpg'">
                            </td>
                            <td><img src="{{ $item['bukti'] }}" alt="bukti pembayaran"></td>
                            <td style="text-align: center">
                                @if ($item['status'] == 'waiting')
                                    <span class="badge badge-info">Menunggu Persetujuan</span>
                                @elseif($item['status'] == 'verified')
                                    <span class="badge badge-success">Disetujui</span>
                                @elseif($item['status'] == 'rejected')
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
