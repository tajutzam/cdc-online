@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if ($errors->any())
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                <div class="text-white">{{ $errors->first() }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white;">
                            <li class="breadcrumb-item">
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                                        <path
                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                                        <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Rekening</li>
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

                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#add-admin" type=""><i class="fas fa-plus"></i>Tambah
                                Rekening</button>

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
                                        <th>No</th>
                                        <th>Rekening</th>
                                        <th>Tipe Bank</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $item)
                                        <tr class="text-start">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->va_number }}</td>

                                            </td>
                                            <td>{{ $item->bank }}</td>
                                            <td>
                                                <div class="row text-center">
                                                    <div class="col-12">
                                                        {{-- <a href="" class="" data-bs-target="#delete" data-id=""
                                                        data-bs-toggle="modal"><i class="fa-solid fa-trash"
                                                            style="color: #ff0f27;"></i></a> --}}
                                                        <a href="#" class="edit-btn" data-bs-target="#edit-rekening"
                                                            data-toggle="modal" data-id="{{ $item->id }}"
                                                            data-va-number="{{ $item->va_number }}"
                                                            data-nominal="{{ $item->nominal }}"
                                                            data-bank="{{ $item->bank }}">
                                                            <i class="fa-solid fa-pen-to-square" style="color:#005eff;"></i>
                                                        </a>
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

    <x-modal-small id="edit-rekening" footer="footer" title="title" body="body">
        <x-slot name="title">Edit Rekening</x-slot>
        <x-slot name="id">edit-rekening</x-slot>
        <x-slot name="body">

            <form action="{{ route('rekening-put') }}" method="post">
                @method('put')
                @csrf
                <input type="text" id="id_payment" hidden name="id">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="va_number"
                        name="va_number"></input>
                    <label for="va_number">No Rekening</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="bank"
                        name="bank"></input>
                    <label for="bank">Tipe Bank</label>
                </div>

                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal-small>

    <x-modal-small id="add-admin" footer="footer" title="title" body="body">
        <x-slot name="title">Tambah Rekening</x-slot>
        <x-slot name="id">add-admin</x-slot>
        <x-slot name="body">

            <form action="{{ route('rekening-post') }}" method="post">
                @method('post')
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="va_number"></input>
                    <label for="floatingTextarea">No Rekening</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="bank"></input>
                    <label for="floatingTextarea">Tipe Bank</label>
                </div>

                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal-small>
    <x-modal-small id="delete" footer="footer" title="title" body="body">
        <x-slot name="title">Hapus Rekening</x-slot>

        <x-slot name="body">
            <div class="mb-3" style="text-align: start;  font-size: 16px; ">Apakah anda yakin ingin menghapus Data ini
                ? </div>
            <form action="" method="post">
                <input type="text" hidden id="" name="id">

                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tidak</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4" type="submit">Ya</button>
                </div>
            </form>
        </x-slot>
    </x-modal-small>


    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                $('#va_number').val($(this).data('va-number'));
                $('#id_payment').val($(this).data('id'));
                $('#nominal').val($(this).data('nominal'));
                $('#bank').val($(this).data('bank'));
                $('#edit-rekening').modal('show');
            });
        });
    </script>
@endsection
