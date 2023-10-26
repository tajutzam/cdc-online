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
            <div class="col-lg-4 ">
                <div class="card m-1 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Berita</p>
                                <h4 class="my-1">{{ $total['total'] }}</h4>

                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i
                                    class='bx bxs-paper-plane'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 ">
                <div class="card m-1">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Berita Aktif</p>
                                <h4 class="my-1">{{ $total['active'] }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-warning text-warning ms-auto"><i
                                    class='bx bxs-paper-plane'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 ">
                <div class="card m-1">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Berita Tidak Aktif</p>
                                <h4 class="my-1">{{ $total['nonactive'] }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i
                                    class='bx bxs-paper-plane'></i>
                            </div>
                        </div>
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
                        data-bs-target="#add-news">Tambah
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
                <img id="img-news" class="  shadow-4-strong" alt="image-uploader" style="height: 100%; width: 100%" />
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
                <input type="checkbox" name="active" id="active" value="1">
                <label for="" class="form-label">Aktif</label>
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
@endsection
