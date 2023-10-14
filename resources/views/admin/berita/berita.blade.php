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

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

        <div class="">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Berita</li>
                </ol>
            </nav>
        </div>
    </div>
    <button class="btn btn-outline-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#add-news">Tambah
        Berita</button>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3">
        @foreach ($data['data'] as $item)
            <div class="col">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $item['image'] }}" alt="foto berita" class="card-img"
                                style="width: 100%; height: 100%;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-truncate" style="max-height: 400px;">{{ $item['title'] }}</h5>
                                <p class="card-text text-truncate" style="max-height: 400px;">{{ $item['description'] }}</p>
                                <p class="card-text"><small class="text-muted">Last updated {{ $item['interval'] }}</small>
                                </p>
                                <div class="row-cols-12">
                                    <button class="btn delete-news-btn" data-bs-target="#delete-news"
                                        data-id="{{ $item['id'] }}" data-bs-toggle="modal"><i class="fa-solid fa-trash"
                                            style="color: #f94f06;"></i></button>
                                    <button class="btn update-news-btn" data-bs-toggle="modal"
                                        data-news="{{ json_encode($item) }}" data-bs-target="#update-news"><i
                                            class="fa-regular fa-pen-to-square" style="color: #005eff;"></i></button>
                                </div>
                            </div>
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


    <x-modal id="add-news" footer="footer" title="title" body="body">
        <x-slot name="title">Tambah Berita</x-slot>
        <x-slot name="id">add-news</x-slot>
        <x-slot name="body">
            <form action="{{ route('berita-post') }}" method="post" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" required id="floatingTextarea"
                        name="title"></input>
                    <label for="floatingTextarea">Judul</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea type="text" class="form-control form-control-sm" required id="floatingTextarea" name="description"></textarea>
                    <label for="floatingTextarea">Description / Content</label>
                </div>
                <div class="mb-3">
                    <input class="form-control form-control-sm" name="image" required id="formFileSm" type="file"
                        accept="image/*">
                </div>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">close</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4">Save</button>
                </div>
            </form>
        </x-slot>
    </x-modal>

    <x-modal id="delete-news" footer="footer" title="title" body="body">
        <x-slot name="title">Hapus Berita</x-slot>
        <x-slot name="id">delete-news</x-slot>
        <x-slot name="body">
            <h5 class="mb-3">Apakah anda yakin ingin menghapus data ini ? </h5>
            <form action="{{ route('berita-delete') }}" method="POST" >
                <input type="text" hidden id="news-delete-id" name="id">
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
        $(document).ready(function() {
            // declare
            var title = $('#title-update');
            var description = $('#description-update');
            var active = $('#active');
            var img_news = $('#img-news');
            var imgInput = $('#image');
            var news_id = $('#news-id');
            var news_delete_id = $('#news-delete-id');
            $('.update-news-btn').click(function() {
                let news = $(this).data('news');
                active.prop('checked', news.active);
                title.val(news.title);
                news_id.val(news.id);
                img_news.attr('src', news.image);
                description.val(news.description);
            });

            $('.delete-news-btn').click(function() {
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
@endsection
