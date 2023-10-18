@extends('layouts.app')


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
            <div class="text-white">{{ $errors->first() }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- @if (session('success'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="text-white">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}

    <div class="row gap-4">
        <div class="card radius-10 col-lg-3 col-md-4 col-sm-12 ">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Alumni Yang Mengisi Quisioner</p>
                        <h4 class="my-1">{{ $data['count']['active'] }}</h4>
                    </div>
                    <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-user-badge'></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card radius-10 col-lg-3 col-md-4 col-sm-12 ">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Alumni Yang Belum Mengisi Quisioner</p>
                        <h4 class="my-1">{{ $data['count']['nonactive'] }}</h4>
                    </div>
                    <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-user-account'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

        <div class="">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Alumni </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="row p-2 justify-content-between">
            <div class="col">
                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-news">Tambah
                    Alumni</button>
            </div>
            <div class="col-3">
                <select class="form-select form-select-sm" id="filter-user" aria-label="Small select example">
                    <option value="filter">Filter</option>
                    <option value="1">Terverifikasi</option>
                    <option value="0">Belum Terferivikasi</option>
                </select>
            </div>
        </div>
    </div>


    <div class="card row align-items-start py-2 table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Prodi</th>
                    <th>Nama Prodi</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Tahun Lulus</th>
                    <th>Tahun Masuk</th>
                    <th>Status Quisioner</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['alumni'] as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @if ($item['prodi'] != null)
                            <td>{{ $item['prodi']['id'] }}</td>
                            <td>{{ $item['prodi']['nama_prodi'] }}</td>
                        @else
                            <td>-</td>
                            <td>-</td>
                        @endif
                        <td>{{ $item['email'] }}</td>
                        <td>{{ $item['foto'] }}</td>
                        <td>2025</td>
                        <td>2021</td>
                        <td>{{ $item['account_status'] }}</td>
                        <td class="">
                            <div class="row text-center">
                                <a href=""><i class="fa-solid fa-circle-info" style="color: #005eff;"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Kode Prodi</th>
                    <th>Nama Prodi</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Tahun Lulus</th>
                    <th>Tahun Masuk</th>
                    <th>Status Quisioner</th>
                    <th>Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <x-modal id="add-news" footer="footer" title="title" body="body">
        <x-slot name="title">Tambah Program Study</x-slot>
        <x-slot name="id">add-news</x-slot>
        <x-slot name="body">
            <form action="{{ route('prodi-post') }}" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control form-control-sm" required id="floatingTextarea"
                        name="id"></input>
                    <label for="floatingTextarea">Kode Prodi</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea type="text" class="form-control form-control-sm" required id="floatingTextarea" name="nama_prodi"></textarea>
                    <label for="floatingTextarea">Nama Program Study</label>
                </div>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">close</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4">Save</button>
                </div>
            </form>
        </x-slot>
    </x-modal>

    <x-modal id="update-prodi" footer="footer" title="title" body="body">
        <x-slot name="title">Update Program Study</x-slot>
        <x-slot name="id">update-prodi</x-slot>
        <x-slot name="body">
            <form action="{{ route('prodi-put') }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" readonly class="form-control form-control-sm" required id="id_update"
                        name="id_update"></input>
                    <label for="floatingTextarea">Kode Prodi</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea type="text" class="form-control form-control-sm" required id="nama_program_update"
                        name="nama_prodi_update"></textarea>
                    <label for="floatingTextarea">Nama Program Study</label>
                </div>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">close</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4">Save</button>
                </div>
            </form>
        </x-slot>
    </x-modal>

    <x-modal id="delete-prodi" footer="footer" title="title" body="body">
        <x-slot name="title">Hapus Berita</x-slot>
        <x-slot name="id">delete-prodi</x-slot>
        <x-slot name="body">
            <h5 class="mb-3">Apakah anda yakin ingin menghapus data ini ? </h5>
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
        <x-slot name="title">Update Berita</x-slot>
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
                    <label for="floatingTextarea">Description / Content</label>
                </div>
                <div class="mb-3">
                    <input class="form-control form-control-sm" name="image-update" id="image" type="file"
                        accept="image/*">
                </div>
                <input type="checkbox" name="active" id="active" value="1">
                <label for="" class="form-label">Aktif</label>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">close</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4" type="submit">Save</button>
                </div>
            </form>
        </x-slot>
    </x-modal>

    <script>
        var filter = document.getElementById('filter-user');
        console.log(filter);

        const urlParams = new URLSearchParams(window.location.search);
        const activeParam = urlParams.get("active");
        console.log(activeParam);
        if (activeParam === "0" || activeParam === "1") {
            filter.value = activeParam;
        }

        filter.addEventListener("change", function(event) {
            // Mendapatkan nilai yang dipilih
            const selectedValue = event.target.value;

            // Lakukan sesuatu dengan nilai yang dipilih
            console.log("Nilai yang dipilih: " + selectedValue);
            if (selectedValue === "1") {
                // Jika nilai yang dipilih adalah "1," reload halaman dengan parameter "?active=1"
                window.location.href = window.location.href.split('?')[0] + '?active=1';
            } else if (selectedValue == "0") {
                window.location.href = window.location.href.split('?')[0] + '?active=0';
            } else {
                window.location.href = window.location.href.split('?')[0];
            }

            // Anda bisa melakukan sesuatu berdasarkan nilai yang dipilih di sini
        });

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
