@extends('layouts.app')


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
            <div class="text-white">{{ $errors->first() }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row gap-4">
        <div class="card radius-10 col-lg-3 col-md-4 col-sm-12 ">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total</p>
                        <h4 class="my-1">{{ sizeof($data) }}</h4>

                    </div>
                    <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-book-open'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-database" viewBox="0 0 16 16">
                                    <path
                                        d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z" />
                                </svg></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Program Studi </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card row align-items-start">
        <button class="btn btn-outline-primary btn-sm mb-3 w-auto m-3" data-bs-toggle="modal"
            data-bs-target="#add-news">Tambah
            Program Studi</button>
    </div>

    <div class="card row align-items-start py-2">
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
                                    <a href="" data-bs-target="#delete-prodi" data-bs-toggle="modal"
                                        class="delete-prodi-btn" data-yes ="yes" data-id="{{ $item['id'] }}"
                                        data-kode={{ $item['id'] }}><i class="fa-solid fa-trash"
                                            style="color: #ff0f27;"></i></a>
                                </div>
                                <div class="col-6">
                                    <a href="" class="update-prodi-btn" data-bs-target="#update-prodi"
                                        data-bs-toggle="modal" data-kode={{ $item['id'] }}
                                        data-nama={{ $item['nama_prodi'] }}><i class="fa-solid fa-pen-to-square"
                                            style="color: #005eff;"></i></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <x-modal id="add-news" footer="footer" title="title" body="body">
        <x-slot name="title">Tambah Program Studi</x-slot>
        <x-slot name="id">add-news</x-slot>
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
    </x-modal>

    <x-modal id="update-prodi" footer="footer" title="title" body="body">
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
    </x-modal>

    <x-modal id="delete-prodi" footer="footer" title="title" body="body">
        <x-slot name="title">Hapus Berita</x-slot>
        <x-slot name="id">delete-prodi</x-slot>
        <x-slot name="body">
            <div class="mb-3" style="text-align: center;  font-size: 16px; ">Apakah anda yakin ingin menghapus Data ini
                ? </div>
            <form action="{{ route('prodi-delete') }}" method="POST">
                <input type="text" hidden id="prodi-delete-id" name="id_delete">
                @method('delete')
                @csrf
                <div class="row justify-content-center">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tidak</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4" type="submit">Ya</button>
                </div>
            </form>
        </x-slot>
    </x-modal>

    <x-modal id="update-news" footer="footer" title="title" body="body">
        <x-slot name="title">Perbarui Berita</x-slot>
        <x-slot name="id">update-news</x-slot>
        <x-slot name="body">
            <form action="{{ route('berita-update') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <img id="img-news" class="  shadow-4-strong" alt="image-uploader" style="height: 100%; width: 100%" />
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="title-update"
                        name="title"></input>
                    <label for="floatingTextarea">Judul</label>
                </div>
                <input type="hidden" name="id" id="news-id">
                <div class="form-floating mb-3">
                    <textarea type="text" class="form-control form-control-sm" required id="description-update" name="description"></textarea>
                    <label for="floatingTextarea">Deskripsi</label>
                </div>
                <div class="mb-3">
                    <input class="form-control form-control-sm" name="image-update" id="image" type="file"
                        accept="image/*">
                </div>
                <input type="checkbox" name="active" id="active" value="1">
                <label for="" class="form-label">Aktif</label>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4" type="submit">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal>

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
