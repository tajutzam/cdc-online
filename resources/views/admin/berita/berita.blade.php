@extends('layouts.app')


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
            <div class="text-white">{{ $errors->first() }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success border-0 bg-success alert-dismissible fade show">
            <div class="text-white">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="card m-1 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Berita</p>
                                <h4 class="my-1">{{ $total['total'] }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-warning text-warning ms-auto"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                    class="bi bi-newspaper" viewBox="0 0 16 16">
                                    <path
                                        d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z" />
                                    <path
                                        d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z" />
                                </svg>
                            </div>
                        </div>
                        <div id="news-accept"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="mt-4">
                <div class="col">
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                            class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Berita</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="row ps-3">
                    <button class="btn btn-outline-primary btn-sm mb-3 w-auto m-3" data-bs-toggle="modal"
                        data-bs-target="#add-news"><i class="fas fa-plus"></i> Tambah
                        Berita</button>

                </div>
            </div>
        </div>


        <div class="row ps-3 pe-3 justify-content-between gap-1">
            @foreach ($data['data'] as $item)
                <div class="card p-0" style="width: 18rem;">
                    <div class="card-header">
                        <h5 class="card-title  m-0" style="max-height: 400px;">
                            {{ $item['title'] }}
                        </h5>
                    </div>
                    <img class="card-img-top  pt-3" src="{{ $item['image'] }}" alt="foto berita" class="card-img">

                    <div class="card-body">
                        <div class="row m-o">
                            <div class="row ">
                                <p class="card-text text-truncate" style="max-height: 400px;">
                                    {{ strip_tags($item['description']) }}</p>
                            </div>

                            <div class="d-flex justify-content-end gap-2 p-2">
                                <button class="btn btn-danger delete-news-btn " data-bs-target="#delete-news"
                                    data-id="{{ $item['id'] }}" data-bs-toggle="modal"><i class="fa-solid fa-trash"
                                        style="color: white;"></i></button>
                                <button class="btn btn-primary update-news-btn" data-bs-toggle="modal"
                                    data-news="{{ json_encode($item) }}" data-bs-target="#update-news"><i
                                        class="fa-regular fa-pen-to-square" style="color: white;"></i></button>
                            </div>

                            <div class="row">
                                <p class="card-text"><small class="text-muted">Terakhir diperbarui
                                        {{ $item['interval'] }}</small>
                                </p>
                            </div>
                        </div>




                    </div>
                </div>
            @endforeach

        </div>
        <nav aria-label="...">
            <ul class="pagination pagination-sm">
                <li class="page-item {{ $data['pagination']['current_page'] == 1 ? 'disabled' : '' }}">
                    <a class="page-link"
                        href="{{ $data['pagination']['current_page'] == 1 ? 'javascript:;' : route('berita', ['page' => $data['pagination']['current_page'] - 1]) }}"
                        tabindex="-1"
                        aria-disabled="{{ $data['pagination']['current_page'] == 1 ? 'true' : 'false' }}">Previous</a>
                </li>

                @for ($page = 1; $page <= $data['pagination']['last_page']; $page++)
                    <li class="page-item {{ $data['pagination']['current_page'] == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ route('berita', ['page' => $page]) }}">{{ $page }}</a>
                    </li>
                @endfor

                <li
                    class="page-item {{ $data['pagination']['current_page'] == $data['pagination']['last_page'] ? 'disabled' : '' }}">
                    <a class="page-link"
                        href="{{ $data['pagination']['current_page'] == $data['pagination']['last_page'] ? 'javascript:;' : route('berita', ['page' => $data['pagination']['current_page'] + 1]) }}">Next</a>
                </li>
            </ul>
        </nav>

    </div>




    <x-modal-large id="add-news" footer="footer" title="title" body="body">
        <x-slot name="title">Tambah Berita</x-slot>
        <x-slot name="id">add-news</x-slot>
        <x-slot name="body">
            <form action="{{ route('berita-post') }}" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="title">
                    <label for="floatingTextarea">Judul</label>
                </div>

                <div class="form-floating mb-3">
                    {{-- <textarea type="text" class="form-control form-control-sm" required id="" name=""></textarea> --}}
                    {{-- <input id="floatingTextarea" type="hidden" name="description" value="" /> --}}
                    <trix-editor input="description" class="trix-content"></trix-editor>
                    <input type="text" id="description" name="description" hidden>
                    {{-- <input type="submit" name="submit" value="Submit" /> --}}
                </div>
                <div class="mb-3">
                    <p style="color:gray">*Gunakan foto dengan ukuran 16:9</p>
                    <input class="form-control form-control-sm" name="image" required id="formFileSm" type="file"
                        accept="image/*">
                </div>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal-large>

    <x-modal-small id="delete-news" footer="footer" title="title" body="body">
        <x-slot name="title">Hapus Berita</x-slot>
        <x-slot name="id">delete-news</x-slot>
        <x-slot name="body">
            <h5 class="mb-3">Apakah anda yakin ingin menghapus data ini ? </h5>
            <form action="{{ route('berita-delete') }}" method="POST">
                <input type="text" hidden id="news-delete-id" name="id">
                @method('delete')
                @csrf
                <div class="row justify-content-center m-0">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tidak</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4" type="submit">Ya</button>
                </div>
            </form>
        </x-slot>
    </x-modal-small>

    <x-modal-large id="update-news" footer="footer" title="title" body="body">
        <x-slot name="title">Update Berita</x-slot>
        <x-slot name="id">update-news</x-slot>
        <x-slot name="body">
            <form action="{{ route('berita-update') }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <img id="img-news" class="  shadow-4-strong" alt="image-berita" style="height: 100%; width: 100%" />
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="title-update"
                        name="title"></input>
                    <label for="floatingTextarea">Judul</label>
                </div>
                <input type="hidden" name="id" id="news-id">
                <div class="form-floating mb-3">
                    <trix-editor id="trix-update-description" input="description-update"
                        class="trix-content"></trix-editor>
                    <textarea type="text" class="form-control form-control-sm" required id="description-update" name="description"
                        hidden></textarea>

                </div>
                <div class="mb-3">
                    <input class="form-control form-control-sm" name="image-update" id="image" type="file"
                        accept="image/*">
                </div>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4" type="submit">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal-large>

    <script>
        $(document).ready(function() {
            // declare
            var title = $('#title-update');
            var description = $('#trix-update-description');
            var active = $('#active');
            var img_news = $('#img-news');
            var imgInput = $('#image');
            var news_id = $('#news-id');
            var news_delete_id = $('#news-delete-id');
            $('.update-news-btn').on('click', function() {
                let news = $(this).data('news');
                active.prop('checked', news.active);
                title.val(news.title);
                news_id.val(news.id);
                img_news.attr('src', news.image);
                description.val(news.description);
            });

            $('.delete-news-btn').on('click', function() {
                let id = $(this).data('id');
                news_delete_id.val(id);
            });

            imgInput.change(function() {
                var fileInput = this;
                var imgTag = $('#img-news');
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        imgTag.attr('src', e.target.result);
                    };

                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
        });
    </script>
    <script>
        $(function() {
            // chart 1
            e = {
                series: [{
                    name: "news Accept",
                    data: {!! json_encode($count['all']) !!}
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
                        color: "#ffc107"
                    },
                    sparkline: {
                        enabled: !0
                    }
                },
                markers: {
                    size: 0,
                    colors: ["#ffc107"],
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
                colors: ["#ffc107"],
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ]
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
            new ApexCharts(document.querySelector("#news-accept"), e).render();
        });
    </script>
@endsection
