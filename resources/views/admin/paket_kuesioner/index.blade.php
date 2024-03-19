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
                            <li class="breadcrumb-item active" aria-current="page">Data Kuesioner</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="row justify-content-start">
                        <div class="col">
                            <a href="{{ route('paket_kuesioner.create') }}" style="text-decoration: none"><button
                                    class="btn btn-outline-primary btn-sm" type=""><i class="fas fa-plus"></i>Tambah
                                    Kuesioner</button></a>

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

                            <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Tipe</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($paketKuesioners as $paketKuesioner)
                                        <tr>
                                            <td>{{ $paketKuesioner->judul }}</td>
                                            <td>{{ $paketKuesioner->tipe }}</td>
                                            <td>{{ $paketKuesioner->created_at->format('Y M d') }}</td>
                                            <td>
                                                @if ($paketKuesioner->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Non-Active</span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('paket_kuesioner.duplicateData', $paketKuesioner->id) }}"
                                                        class="btn btn-info me-2">Duplicate</a>
                                                    @if ($paketKuesioner->status == 1)
                                                        <a href="{{ route('paket_kuesioner.changeStatus', [$paketKuesioner->id, $paketKuesioner->status == '1' ? '0' : '1']) }}"
                                                            class="btn btn-danger me-2">Inactive</a>
                                                    @else
                                                        <a href="{{ route('paket_kuesioner.changeStatus', [$paketKuesioner->id, $paketKuesioner->status == '1' ? '0' : '1']) }}"
                                                            class="btn btn-success me-2">Activate</a>
                                                    @endif
                                                    <a href="{{ route('paket_kuesioner.edit', $paketKuesioner->id) }}"
                                                        class="btn btn-warning me-2">Edit</a>
                                                    <a href="{{ route('paket_kuesioner.view', $paketKuesioner->id) }}">
                                                        <div class="btn btn-secondary me-2">
                                                            Lihat
                                                        </div>
                                                    </a>

                                                    <a href="{{ route('paket_kuesioner.destroy', $paketKuesioner->id) }}"
                                                        class="btn btn-danger" type="submit"
                                                        data-confirm-delete="true">Hapus</a>


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
