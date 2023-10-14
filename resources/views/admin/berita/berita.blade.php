@extends('layouts.app')


@section('content')
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
    <button class="btn btn-outline-primary btn-sm mb-3">Tambah Berita</button>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
        @foreach ($data as $item)
            <div class="col">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('/') }}assets/images/gallery/10.png" alt="..." class="card-img">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$item['title']}}</h5>
                                <p class="card-text">{{$item['description']}}</p>
                                <p class="card-text"><small class="text-muted">Last updated {{$item['interval']}}</small>
                                </p>
                                <div class="row-cols-12">
                                    <button class="btn"><i class="fa-solid fa-trash"
                                            style="color: #f94f06;"></i></button>
                                    <button class="btn"><i class="fa-regular fa-pen-to-square"
                                            style="color: #005eff;"></i></button>
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
            <li class="page-item disabled"><a class="page-link" href="javascript:;" tabindex="-1"
                    aria-disabled="true">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="javascript:;">1</a>
            </li>
            <li class="page-item" aria-current="page"><a class="page-link" href="javascript:;">2 <span
                        class="visually-hidden">(current)</span></a>
            </li>
            <li class="page-item active"><a class="page-link" href="javascript:;">3</a>
            </li>
            <li class="page-item"><a class="page-link" href="javascript:;">Next</a>
            </li>
        </ul>
    </nav>
@endsection
