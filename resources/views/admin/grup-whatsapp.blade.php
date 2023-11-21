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
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Jumlah Grup Whatsapp</p>
                                <h4 class="my-1">{{ sizeof($data['groups']) }}</h4>
                                <p class="mb-0 font-13 text-success"><i class='bx bxs-up-arrow align-middle'></i>
                                    Ditambahkan
                                    {{ $data['countLastWeek'] }}
                                    Grup Minggu ini</p>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                                </svg>
                            </div>
                        </div>
                        <div id="whatsapp"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Grup Whatsapp</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body text-start">
                        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#add-grup">
                            <i class="fas fa-plus"></i> Tambah Grup Whatsapp
                        </button>

                    </div>
                </div>

            </div>
        </div>
        <div class="row  pe-3 ps-3 justify-content-start gap-lg-5">
            @foreach ($data['groups'] as $item)
                <div class="card p-0" style="width: 18rem;">
                    <div class="card-body text-center">
                        <img class="rounded-circle bg-success mx-auto" style="width: 200px; height: 200px;"
                            src="{{ $item['image'] }}"
                            onerror="this.onerror=null;this.src='{{ asset('/') }}assets/images/nullsquare.jpg';">


                        <!-- Isi dari div bulat -->
                        <h4 class="card-title m-3">{{ $item['name'] }}</h4>
                        <!-- Tombol Tautan (Link) -->
                        <div class="pb-2">
                            <a href="{{ $item['url'] }}" target="_blank" class="btn btn-success">
                                <i class="fas fa-link"></i> Tautan
                            </a>
                        </div>


                        <!-- Tombol Hapus -->
                        <button class="btn btn-danger ml-2 delete-grup-btn" data-id="{{ $item['id'] }}"
                            data-bs-toggle="modal" data-bs-target="#delete-grup">
                            <i class="fas fa-trash"></i> Hapus
                        </button>

                        <!-- Tombol Perbarui -->
                        <button class="btn btn-primary ml-2 update-grup-btn" data-bs-toggle="modal"
                            data-bs-target="#update-grup" data-id="{{ $item['id'] }}" data-name="{{ $item['name'] }}"
                            data-url="{{ $item['url'] }}">
                            <i class="fas fa-sync-alt"></i> Perbarui
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        $(function() {
            // chart 1
            var e = {
                series: [{
                    name: "Whatsapp",
                    data: {!! json_encode($data['countPerDay']) !!}
                }],
                chart: {
                    type: "line",
                    height: 65,
                    toolbar: {
                        show: !1
                    },
                    zoom: {
                        enabled: !1
                    },
                    dropShadow: {
                        enabled: !0,
                        top: 3,
                        left: 14,
                        blur: 4,
                        opacity: .12,
                        color: "#17a00e"
                    },
                    sparkline: {
                        enabled: !0
                    }
                },
                markers: {
                    size: 0,
                    colors: ["#17a00e"],
                    strokeColors: "#fff",
                    strokeWidth: 2,
                    hover: {
                        size: 7
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    show: !0,
                    width: 3,
                    curve: "smooth"
                },
                colors: ["#17a00e"],
                xaxis: {
                    categories: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    theme: "dark",
                    fixed: {
                        enabled: !1
                    },
                    x: {
                        show: !1
                    },
                    y: {
                        title: {
                            formatter: function(e) {
                                return ""
                            }
                        }
                    },
                    marker: {
                        show: !1
                    }
                }
            };
            new ApexCharts(document.querySelector("#whatsapp"), e).render();

        });
    </script>

    <x-modal-small id="add-grup" footer="footer" title="title" body="body">
        <x-slot name="title">Tambah Grup</x-slot>
        <x-slot name="id">add-grup</x-slot>
        <x-slot name="body">

            <form action="{{ route('grup-post') }}" method="post" enctype="multipart/form-data">
                @method('post')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="name">
                    <label for="floatingTextarea">Nama Wilayah</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="url">
                    <label for="floatingTextarea">Tautan</label>
                </div>
                <div class="mb-3">
                    <p style="color:gray">*Gunakan foto dengan ukuran 1:1</p>
                    <input class="form-control form-control-sm" name="image" required id="formFileSm" type="file"
                        accept="image/*">
                </div>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4" type="submit">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal-small>

    <x-modal-small id="delete-grup" footer="footer" title="title" body="body">
        <x-slot name="title">Hapus Grup</x-slot>
        <x-slot name="id">delete-grup</x-slot>
        <x-slot name="body">
            <form action="{{ route('grup-delete') }}" method="post" enctype="multipart/form-data">
                @method('delete')
                <div class="form-floating mb-3">
                    <h6> Apakah anda yakin menghapus Grup ?</h6>
                </div>
                <input type="text" name="id" id="id_delete" hidden>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal-small>

    <x-modal-small id="update-grup" footer="footer" title="title" body="body">
        <x-slot name="title">Perbarui Grup</x-slot>
        <x-slot name="id">update-grup</x-slot>
        <x-slot name="body">

            <form action="{{ route('grup-put') }}" method="post" enctype="multipart/form-data">
                @method('put')
                <input type="text" name="id" id="id-update" hidden>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nama-wilayah-update" placeholder="Nama Wilayah"
                        name="name">
                    <label for="nama-wilayah">Nama Wilayah</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="tautan-update" placeholder="Tautan" name="url">
                    <label for="tautan">Tautan</label>
                </div>


                <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="image-update" name="image" accept="image/*">
                    <label for="gambar">Gambar</label>
                </div>

                <div class="mb-3">
                    <img id="gambar-preview" src="" alt="Preview" style="max-width: 100px; display: none;">
                </div>

                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal-small>


    <script>
        $(document).ready(function() {
            // declare

            $('.delete-grup-btn').on('click', function() {
                console.log('ya');
                let id = $(this).data('id');
                var id_input = $('#id_delete');
                id_input.val(id);

            });

            $('.update-grup-btn').on('click', function() {
                console.log('ya');
                let id = $(this).data('id');
                let name = $(this).data('name');
                let tautan = $(this).data('url');
                var name_input = $('#nama-wilayah-update');
                var tautan_input = $('#tautan-update');
                let id_input = $('#id-update');
                name_input.val(name);
                tautan_input.val(tautan);
                id_input.val(id);
            });

            $('#example').on('click', '.delete-prodi-btn', function() {
                let id = $(this).data('kode');
                console.log(id);
                $('#prodi-delete-id').val(id);
            });
        });
    </script>
@endsection
