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
                                        <th>Tipe</th>
                                        <th>Masa Berlaku</th>
                                        <th>Nominal Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $item)
                                        <tr class="text-start">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->post_package }}</td>
                                            <td>
                                                @if ($item->type == 'information')
                                                    <span class="badge badge-warning">Informasi</span>
                                                @elseif ($item->type == 'vacancy')
                                                    <span class="badge badge-info">Lowongan</span>
                                                @elseif ($item->type == 'information+vacancy')
                                                    <span class="badge badge-primary">Informasi dan Lowongan</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->exp_date }} Hari</td>
                                            <td>{{ $item->pay_nominal }}</td>
                                            <td>
                                                <div class="row text-center">
                                                    <div class="col-6">
                                                        <a href="#" class="edit-btn" data-bs-target="#edit-pay"
                                                            data-toggle="modal" data-id="{{ $item->id }}"
                                                            data-post-package="{{ $item->post_package }}"
                                                            data-exp-date="{{ $item->exp_date }}"
                                                            data-type="{{ $item->type }}"
                                                            data-pay-nominal="{{ $item->pay_nominal }}">
                                                            <i class="fa-solid fa-pen-to-square" style="color:#005eff;"></i>
                                                        </a>

                                                    </div>

                                                    <div class="col-6">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete-pay" data-id="{{ $item->id }}">
                                                            <i class="fa-solid fa-trash" style="color: #ff0f27;"></i>
                                                        </a>
                                                    </div>
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

    <x-modal-small id="edit-pay" footer="footer" title="title" body="body">
        <x-slot name="title">Edit Paket</x-slot>
        <x-slot name="id">edit-pay</x-slot>
        <x-slot name="body">

            <form action="{{ route('pay-put') }}" method="post">
                @method('put')
                @csrf
                <input type="hidden" id="id_payment" name="id">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="post_package"
                        name="post_package" value="{{ old('post_package') }}">
                    <label for="post_package">Paket Postingan</label>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Tipe</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input name="type" class="form-check-input" type="radio" id="gridRadios1"
                                    value="vacancy">
                                <label class="form-check-label" for="gridRadios1">
                                    Lowongan
                                </label>
                            </div>
                            <div class="form-check">
                                <input name="type" class="form-check-input" type="radio" id="gridRadios2"
                                    value="information">
                                <label class="form-check-label" for="gridRadios2">
                                    Informasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input name="type" class="form-check-input" type="radio" id="gridRadios3"
                                    value="information+vacancy">
                                <label class="form-check-label" for="gridRadios3">
                                    Informasi dan Lowongan
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control form-control-sm" required id="exp_date" name="exp_date">
                    <label for="floatingTextarea">Jumlah Hari</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="pay_nominal"
                        name="pay_nominal" value="{{ old('pay_nominal') }}">
                    <label for="pay_nominal">Nominal Pembayaran</label>
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

            <form action="{{ route('pay-post') }}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="post_package">
                    <label for="floatingTextarea">Nama Paket</label>
                </div>

                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Tipe</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input name="type" class="form-check-input" type="radio" id="gridRadios1"
                                    value="vacancy" checked>
                                <label class="form-check-label" for="gridRadios1">Lowongan</label>
                            </div>
                            <div class="form-check">
                                <input name="type" class="form-check-input" type="radio" id="gridRadios2"
                                    value="information">
                                <label class="form-check-label" for="gridRadios2">Informasi</label>
                            </div>
                            <div class="form-check">
                                <input name="type" class="form-check-input" type="radio" id="gridRadios3"
                                    value="information+vacancy">
                                <label class="form-check-label" for="gridRadios3">Informasi dan Lowongan</label>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control form-control-sm" required id="floatingTextarea"
                        name="exp_date">
                    <label for="floatingTextarea">Jumlah Hari</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="pay_nominal">
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
    <x-modal-small id="delete-pay" footer="footer" title="title" body="body">
        <x-slot name="title">Hapus Paket</x-slot>

        <x-slot name="body">
            <div class="mb-3" style="text-align: start; font-size: 16px;">Apakah anda yakin ingin menghapus Data ini?
            </div>
            <form action="{{ route('pay-delete', ['id' => '__ID__']) }}" method="post" id="deleteForm">
                @csrf
                @method('delete')
                <input type="hidden" id="deleteId" name="id">

                <!-- Other form fields if needed -->

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
                $('#post_package').val($(this).data('post-package'));
                $('#exp_date').val($(this).data('exp-date'));
                $('#id_payment').val($(this).data('id'));
                $('#pay_nominal').val($(this).data('pay-nominal'));
                $('#edit-pay').modal('show');
                // Replace $selectedType with the actual value you want to pre-select
                var selectedType = $(this).data('type');


                // Use jQuery to find the radio button with the corresponding value and set it as checked
                $('input[name="type"]').filter('[value="' + selectedType + '"]').prop('checked', true);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var deleteModal = new bootstrap.Modal(document.getElementById('delete-pay'));

            $('#delete-pay').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');

                // Set the id in the modal form
                $('#deleteId').val(id);

                // Set the action attribute dynamically
                var deleteFormAction = $('#deleteForm').attr('action');
                deleteFormAction = deleteFormAction.replace('__ID__', id);
                $('#deleteForm').attr('action', deleteFormAction);
            });

            // Optional: If you want to close the modal on form submission
            $('#deleteForm').submit(function() {
                deleteModal.hide();
            });
        });
    </script>
@endsection
