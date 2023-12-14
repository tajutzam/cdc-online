@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white;">
                            <li class="breadcrumb-item">
                                <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-credit-card" viewBox="0 0 16 16">
                                        <path
                                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                                        <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Paket</li>
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
                            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-pay"
                                type=""><i class="fas fa-plus"></i>Tambah
                                Paket</button>
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
                                        <th>Paket</th>
                                        <th>Nominal Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-start">
                                        <td>1</td>
                                        <td>Paket Komplit</td>
                                        <td>Rp 100</td>
                                        <td>
                                            <div class="row text-center">
                                                <div class="col-12">
                                                    <a href="#" class="edit-btn" data-bs-toggle="modal"
                                                        data-bs-target="#edit-pay" data-id="" data-va-number=""
                                                        data-nominal="" data-bank="">
                                                        <i class="fa-solid fa-pen-to-square" style="color:#005eff;"></i>
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal-small id="edit-pay" footer="footer" title="title" body="body">
        <x-slot name="title">Edit Paket</x-slot>
        <x-slot name="id">edit-Paket</x-slot>
        <x-slot name="body">
            <form action="" method="post">

                <input type="text" id="id_payment" hidden name="id">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="paket"
                        name="paket"></input>
                    <label for="paket">Paket</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="paynominal"
                        name="paynominal"></input>
                    <label for="paynominal">Nominal Pembayaran</label>
                </div>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal-small>

    <x-modal-small id="add-pay" footer="footer" title="title" body="body">
        <x-slot name="title">Tambah Paket</x-slot>
        <x-slot name="id">add-pay</x-slot>
        <x-slot name="body">
            <form action="" method="post">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="paket"></input>
                    <label for="floatingTextarea">Nama Paket</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="nompay"></input>
                    <label for="floatingTextarea">Nominal Pembayaran</label>
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
        <x-slot name="title">Hapus Paket</x-slot>
        <x-slot name="body">
            <div class="mb-3" style="text-align: start; font-size: 16px;">Apakah anda yakin ingin menghapus Data ini?
            </div>
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
@endsection
