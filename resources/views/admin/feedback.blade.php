@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Pesan Masuk</p>
                                <h4 class="my-1">{{ sizeof($data) }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-primary text-primary ms-auto"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-envelope-paper-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6.5 9.5 3 7.5v-6A1.5 1.5 0 0 1 4.5 0h7A1.5 1.5 0 0 1 13 1.5v6l-3.5 2L8 8.75l-1.5.75ZM1.059 3.635 2 3.133v3.753L0 5.713V5.4a2 2 0 0 1 1.059-1.765ZM16 5.713l-2 1.173V3.133l.941.502A2 2 0 0 1 16 5.4v.313Zm0 1.16-5.693 3.337L16 13.372v-6.5Zm-8 3.199 7.941 4.412A2 2 0 0 1 14 16H2a2 2 0 0 1-1.941-1.516L8 10.072Zm-8 3.3 5.693-3.162L0 6.873v6.5Z" />
                                </svg>
                            </div>
                        </div>
                        <div id="feedback-chart"></div>
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
                            <li class="breadcrumb-item active" aria-current="page">Feedback</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach ($data as $item)
                <div class="col-sm-6">
                    <div class="row pt-2">
                        <div class="col-sm">
                            <div class="card pb-0 mb-0" style="background-color: #007bff; border-radius: 10px 10px 0 0;">
                                <h5 class="p-2"
                                    style="padding-inline-start: 10px; margin: 0; color: white; font-weight: bold; height:0%;">
                                    <i class="fas fa-user"></i> {{ $item['name'] }}
                                </h5>
                            </div>
                            <div class="card pt-0 mb-0">
                                <div class="card-body">
                                    <p class="card-text">{{ $item['questions'] }}</p>
                                    @if (isset($item['answer']))
                                        <p class="card-text">{{ $item['answer'] }}</p>
                                    @else
                                        <form method="post" action="{{ route('answer', ['id' => $item['id']]) }}"
                                            class="mt-3">
                                            @csrf
                                            <div class="form-group">
                                                <textarea class="form-control" name="answer" rows="3" placeholder="Balas komentar..."></textarea>
                                            </div>
                                            <div class="button-group">
                                                @if (isset($item['answer']))
                                                
                                                    <button type="button" class="btn btn-danger btn-delete-feedback"
                                                        data-bs-target="#delete-feedback" d data-bs-toggle="modal"
                                                        data-id="{{ $item['id'] }}">Hapus</button>
                                                @endif
                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                            </div>

                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <nav>
            <ul class="pagination justify-content-start pt-3">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                </li>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Selanjutnya</a>
                </li>
            </ul>
        </nav>
    </div>


    <x-modal-small id="delete-feedback" footer="footer" title="title" body="body">
        <x-slot name="title">Hapus Feedback</x-slot>
        <x-slot name="id">delete-feedback</x-slot>
        <x-slot name="body">
            <h5 class="mb-3">Apakah anda yakin ingin menghapus data ini ? </h5>
            <form action="{{ route('feedback-delete') }}" method="POST">
                @method('delete')
                @csrf
                <input type="text" hidden id="feedback-delete-id" name="id">

                <div class="row justify-content-center m-0">
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
            $('.btn-delete-feedback').on('click', function() {
                console.log('ya');
                let id = $(this).data('id');
                var id_input = $('#feedback-delete-id');
                id_input.val(id);
            });
        });
    </script>
@endsection
