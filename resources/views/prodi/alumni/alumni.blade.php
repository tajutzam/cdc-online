@extends('prodi-layouts.app')
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


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Alumni Terverifikasi
                                <h4 class="my-1">{{ $data['count']['active'] }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i
                                    class='bx bxs-user-account'></i>
                            </div>
                        </div>
                        <div id="alumni-chart-verify"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Alumni Belum Terverifikasi</p>
                                <h4 class="my-1">{{ $data['count']['nonactive'] }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i
                                    class='bx bxs-user-account'></i>
                            </div>
                        </div>
                        <div id="alumni-chart-not-verify"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i><i><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                                                <path
                                                    d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z" />
                                            </svg></i></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Alumni </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="row p-2 justify-content-start">
                        <div class="col-3">
                            <select class="form-select form-select-sm" id="filter-user" aria-label="Small select example">
                                <option value="filter">Filter</option>
                                <option value="1">Terverifikasi</option>
                                <option value="0">Belum Terferivikasi</option>
                            </select>
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
                                        <th rowspan="2" style="text-align: center;  vertical-align: middle;">No</th>
                                        <th rowspan="2" style="text-align: center;  vertical-align: middle;">Foto
                                        </th>
                                        <th rowspan="2" style="text-align: center;  vertical-align: middle;">NIM</th>
                                        <th rowspan="2" style="text-align: center;  vertical-align: middle;">NIK</th>
                                        <th rowspan="2" style="text-align: center;  vertical-align: middle;">Nama
                                        </th>
                                        <th rowspan="2" style="text-align: center;  vertical-align: middle;">Program
                                            Studi</th>
                                        <th rowspan="2" style="text-align: center;  vertical-align: middle;">Email
                                        </th>
                                        <th rowspan="2" style="text-align: center;  vertical-align: middle;">Tahun
                                            Lulus
                                        </th>
                                        <th rowspan="2" style="text-align: center;  vertical-align: middle;">Tahun
                                            Masuk
                                        </th>
                                        <th rowspan="2" style="text-align: center;  vertical-align: middle;">Status
                                        </th>
                                        <th colspan="2" style="text-align: center;  vertical-align: middle;">Lokasi
                                        </th>
                                    <tr>
                                        <th>Latitude</th>
                                        <th>Longtitude</th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['alumni'] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td> <img src={{ url('/users/') . '/' . $item['foto'] }} class="rounded-circle"
                                                    width="40" height="40" alt=""
                                                    onerror="this.onerror=null;this.src='{{ asset('/') }}assets/images/user.jpg';">
                                            </td>
                                            <td>{{ $item['nim'] }}</td>
                                            <td>{{ $item['nik'] }}</td>
                                            <td>{{ $item['fullname'] }}</td>

                                            <td>{{ $item['prodi']['nama_prodi'] }}</td>

                                            <td>{{ $item['email'] }}</td>

                                            <td>{{ isset($item['alumni'][0]['tahun_lulus']) ? $item['alumni'][0]['tahun_lulus'] : 'Tidak ada data' }}
                                            </td>
                                            <td>{{ isset($item['alumni'][0]['angkatan']) ? $item['alumni'][0]['angkatan'] : 'Tidak ada data' }}
                                            </td>
                                            @if ($item['account_status'])
                                                <td>
                                                    <div class="badge rounded-pill bg-primary w-100">Terverifikasi</div>
                                                </td>
                                            @else
                                                <td>
                                                    <div class="badge rounded-pill bg-danger w-100">Belum Terverifikasi
                                                    </div>
                                                </td>
                                            @endif
                                            @if ($item['latitude'] == null)
                                                <td style="color: gray">Latitude Tidak Ada</td>
                                            @else
                                                <td>{{ $item['latitude'] }}</td>
                                            @endif

                                            @if ($item['longtitude'] == null)
                                                <td style="color: gray">Longtitude Tidak Ada</td>
                                            @else
                                                <td>{{ $item['longtitude'] }}</td>
                                            @endif
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
                    <label for="floatingTextarea">Nama Program Studi</label>
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
