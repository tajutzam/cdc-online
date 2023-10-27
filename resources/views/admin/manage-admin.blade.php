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
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Admin</p>
                                <h4 class="my-1">10</h4>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                                        <path
                                            d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Admin</li>
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
                                data-bs-target="#add-admin" type=""><i class="fas fa-plus"></i>Tambah Admin</button>

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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>NPWP</th>
                                        <th>Dibuat</th>
                                        <th>Diperbarui</th>
                                        <th>Aksi</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr class="text-start">
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td>{{ $item['email'] }}</td>
                                            <th>{{ $item['npwp'] }}</th>
                                            <td>{{ date('Y-m-d H:i', strtotime($item['created_at'])) }}</td>
                                            <td>{{ date('Y-m-d H:i', strtotime($item['updated_at'])) }}</td>
                                            <td>
                                                <div class="row text-center">
                                                    <div class="col-12">
                                                        <a href="" class="btn-admin-delete"
                                                            data-bs-target="#delete-admin" data-id="{{ $item['id'] }}"
                                                            data-bs-toggle="modal"><i class="fa-solid fa-trash"
                                                                style="color: #ff0f27;"></i></a>
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

    <x-modal-small id="add-admin" footer="footer" title="title" body="body">
        <x-slot name="title">Tambah Admin</x-slot>
        <x-slot name="id">add-admin</x-slot>
        <x-slot name="body">
            <form action="{{ route('manage-admin-post') }}" method="post">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control form-control-sm" required id="floatingTextarea"
                        name="email"></input>
                    <label for="floatingTextarea">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="name"></input>
                    <label for="floatingTextarea">Nama</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control form-control-sm" required id="floatingTextarea"
                        name="npwp"></input>
                    <label for="floatingTextarea">Npwp</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="alamat"></input>
                    <label for="floatingTextarea">Alamat</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="password"></input>
                    <label for="floatingTextarea">Password</label>
                </div>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal-small>
    <x-modal-small id="delete-admin" footer="footer" title="title" body="body">
        <x-slot name="title">Hapus Admin</x-slot>
        <x-slot name="id">delete-admin</x-slot>
        <x-slot name="body">
            <div class="mb-3" style="text-align: start;  font-size: 16px; ">Apakah anda yakin ingin menghapus Data ini
                ? </div>
            <form action="{{ route('manage-admin-delete') }}" method="post">
                <input type="text" hidden id="admin-delete-id" name="id">
                @method('delete')
                @csrf
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
            $(".btn-admin-delete").click(function() {
                var id = $(this).attr('data-id');
                console.log(id); // Ini akan mencetak nilai id ke konsol
                var id = $(this).attr('data-id'); // Mengambil ID dari tombol
                var modal = $("#delete-admin"); // Ganti "delete-admin" dengan ID modal yang sesuai
                modal.find('#admin-delete-id').val(id); // Menetapkan ID ke input dalam modal
            });
        });
    </script>
@endsection
