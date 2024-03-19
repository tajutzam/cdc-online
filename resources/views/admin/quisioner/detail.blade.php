@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="mt-4">
                <div class="col p-0">
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                                <li class="breadcrumb-item"><a href="{{ route('quisioner-index') }}"><i
                                            class="bx bxs-book-open"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('quisioner-index') }}">Kuesioner</a>
                                <li class="breadcrumb-item active" aria-current="page">Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 pb-2 text-start">
                <h2> Detail Quesioner </h2> <span class="badge text-bg-success"> Level
                    {{ $data[0]['QuesinerAnswerDetail']['level'] }} Bulan</span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content">
                            <div class="col-sm-6 text-start p-2">
                                <h4 style="margin: 0%">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    </svg>
                                    {{ $data[0]['QuesinerAnswerDetail']['users']['fullname'] }}
                                </h4>
                            </div>
                            {{-- <div class="col-sm-6 text-end">
                                <button class="btn btn-primary btn-sm">Update</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table id="table1" class="table table-striped table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th>Kode Pertanyaan</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        {{-- <th>
                            Aksi
                        </th> --}}

                    </tr>
                </thead>
                <tbody>
                    @if (isset($data))
                        @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ $item['detail']['kode_pertanyaan'] }}</td>
                                <td>{{ $item['detail']['pertanyaan'] }}</td>
                                <td>
                                    {{ str_replace(['[', ']', "'", '"'], '', json_decode($item['answer_value'], true)) }}
                                </td>
                                {{-- <td>
                                    <div class="col-6 ">
                                        <a href="" class="update-detail-btn" data-bs-target="#update-detail"
                                            data-bs-toggle="modal"><i class="fa-solid fa-pen-to-square"
                                                style="color: #005eff;"></i></a>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <script>
            $(document).ready(function() {
                // Initialize DataTables for all 9 tables
                for (var i = 1; i <= 9; i++) {
                    $('#table' + i).DataTable({
                        ordering: false,
                        // Opsi yang bisa Anda tambahkan
                        searching: true, // Aktifkan opsi pencarian
                        lengthChange: true, // Aktifkan opsi filter jumlah data per halaman
                        paging: true, // Aktifkan opsi pagination
                        // Tambahkan opsi lain sesuai kebutuhan
                    });
                }
            });
        </script>
    @endsection
