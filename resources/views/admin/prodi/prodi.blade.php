@extends('layouts.app')


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
            <div class="text-white">{{ $errors->first() }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Program Studi</p>
                                <h4 class="my-1">{{ sizeof($data) }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-primary text-primary ms-auto"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-mortarboard" viewBox="0 0 16 16">
                                    <path
                                        d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5ZM8 8.46 1.758 5.965 8 3.052l6.242 2.913L8 8.46Z" />
                                    <path
                                        d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46l-3.892-1.556Z" />
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
                            <li class="breadcrumb-item active" aria-current="page">Program Studi</li>
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
                            {{-- <form action="{{ route('reference-alumni-update') }}" method="post">
                                @method('put') --}}
                            <button class="btn btn-outline-primary btn-sm " data-bs-toggle="modal"
                                data-bs-target="#add-prodi"><i class="fas fa-plus"></i>Tambah
                                Program Studi</button>
                            {{-- </form> --}}
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
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th style="text-align: center" rowspan="2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <p>{{ $item['id'] }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $item['nama_prodi'] }}</p>
                                            </td>
                                            <td>
                                                <div class="row" style="align-content: center;">
                                                    <div class="col-6">
                                                        <a href="" data-bs-target="#delete-prodi"
                                                            data-bs-toggle="modal" class="delete-prodi-btn" data-yes ="yes"
                                                            data-id="{{ $item['id'] }}" data-kode={{ $item['id'] }}><i
                                                                class="fa-solid fa-trash" style="color: #ff0f27;"></i></a>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="" class="update-prodi-btn"
                                                            data-bs-target="#update-prodi" data-bs-toggle="modal"
                                                            data-kode={{ $item['id'] }}
                                                            data-nama={{ $item['nama_prodi'] }}><i
                                                                class="fa-solid fa-pen-to-square"
                                                                style="color: #005eff;"></i></a>
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
    <x-modal-small id="add-prodi" footer="footer" title="title" body="body">
        <x-slot name="title">Tambah Program Studi</x-slot>
        <x-slot name="id">add-prodi</x-slot>
        <x-slot name="body">
            <form action="{{ route('prodi-post') }}" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control form-control-sm" required id="floatingTextarea"
                        name="id"></input>
                    <label for="floatingTextarea">Kode</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea type="text" class="form-control form-control-sm" required id="floatingTextarea" name="nama_prodi"></textarea>
                    <label for="floatingTextarea">Nama</label>
                </div>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                </div>
            </form>
        </x-slot>
        </x-moda-small>

        <x-modal-small id="update-prodi" footer="footer" title="title" body="body">
            <x-slot name="title">Perbarui Program Studi</x-slot>
            <x-slot name="id">update-prodi</x-slot>
            <x-slot name="body">
                <form action="{{ route('prodi-put') }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" readonly class="form-control form-control-sm" required id="id_update"
                            name="id_update"></input>
                        <label for="floatingTextarea">Kode</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea type="text" class="form-control form-control-sm" required id="nama_program_update"
                            name="nama_prodi_update"></textarea>
                        <label for="floatingTextarea">Nama</label>
                    </div>
                    <div class="row justify-content-end">
                        <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                            data-bs-dismiss="modal">Tutup</button>
                        <button class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                    </div>
                </form>
            </x-slot>
        </x-modal-small>

        <x-modal-small id="delete-prodi" footer="footer" title="title" body="body">
            <x-slot name="title">Hapus Berita</x-slot>
            <x-slot name="id">delete-prodi</x-slot>
            <x-slot name="body">
                <div class="mb-3" style="text-align: start;  font-size: 16px; ">Apakah anda yakin ingin menghapus Data
                    ini
                    ? </div>
                <form action="{{ route('prodi-delete') }}" method="POST">
                    <input type="text" hidden id="prodi-delete-id" name="id_delete">
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
                // declare

                $('.update-prodi-btn').on('click', function() {
                    console.log('ya');
                    let id = $(this).data('kode');

                    let nama = $(this).data('nama');

                    $('#id_update').val(id);
                    $('#nama_program_update').val(nama);
                });

                $('#example').on('click', '.delete-prodi-btn', function() {
                    let id = $(this).data('kode');
                    console.log(id);
                    $('#prodi-delete-id').val(id);
                });
            });
        </script>
    @endsection
