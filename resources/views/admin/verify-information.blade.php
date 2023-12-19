@extends('layouts.app')


@section('content')
    <style>
        table tbody tr td img {
            height: 100px;
        }
    </style>

    <div class="container-fluid">

        <div class="card">

        </div>

        <div class="mt-4">
            <div class="col p-0">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-folder-check" viewBox="0 0 16 16">
                                            <path
                                                d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z" />
                                            <path
                                                d="M15.854 10.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.707 0l-1.5-1.5a.5.5 0 0 1 .707-.708l1.146 1.147 2.646-2.647a.5.5 0 0 1 .708 0z" />
                                        </svg></i>
                                </a>
                            </li>

                            <li class="breadcrumb-item active" aria-current="page">Verifikasi Informasi Mitra</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="table-responsive card p-2">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Perusahaan</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Poster</th>
                        <th>Bukti Pembayaran</th>
                        <th>Perizinan</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['mitra']['name'] }}</td>
                            <td>{{ $item['title'] }}</td>
                            <td style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;max-width: 10em;">
                                {{ $item['description'] }}</td>
                            <td>
                                <img src="{{ $item['poster'] }}" alt="poster" style="height: 100px; "
                                    onerror="this.onerror=null;this.src='{{ asset('/') }}assets/images/nullsquare.jpg'">
                            </td>
                            <td><img src="{{ $item['bukti'] }}" alt="bukti pembayaran"></td>
                            <td style="text-align: center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('information-accept') }}" method="post" class="p-2">
                                        <input type="text" value="verified" hidden name="status">
                                        <input type="text" value="{{ $item['mitra']['id'] }}" hidden name="mitra_id">
                                        <input type="text" value="{{ $item['id'] }}" hidden name="id">
                                        <input type="text" value="{{ $item['pay']['exp_date'] }}" hidden name="pay_day">
                                        <button type="submit" class="btn btn-success">Setuju</button>
                                    </form>
                                    <div class="p-2">
                                        <button href="#" class="reject-btn btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#reject" data-id="{{ $item['id'] }}"
                                            data-mitra-id="{{ $item['mitra']['id'] }}">
                                            Tolak
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <x-modal-medium id="reject" footer="footer" title="title" body="body">
        <x-slot name="title">Tolak Pengajuan Informasi</x-slot>

        <x-slot name="body">
            <form action="{{ route('information-reject') }}" method="post">
                <input type="text" hidden id="" name="id">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="bukti tidak sesuai"
                        name="alasan" required>
                    <input type="text" name="id" id="id_information" hidden>
                    <input type="text" name="mitra_id" id="id_mitra" hidden>
                    <input type="text" name="status" value="rejected" id="id_mitra" hidden>


                    <label for="floatingInput">Alasan Penolakan</label>
                </div>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Batal</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4" type="submit">Kirim</button>
                </div>
            </form>
        </x-slot>
    </x-modal-medium>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.reject-btn', function() {
                var id = $(this).data('id');
                var mitra_id = $(this).data('mitra-id');


                $('#id_information').val(id);
                $('#id_mitra').val(mitra_id);

            })
        });
    </script>
@endsection
