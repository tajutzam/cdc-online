@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mt-4">
            <div class="col p-0">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-easel2-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M8.447.276a.5.5 0 0 0-.894 0L7.19 1H2.5A1.5 1.5 0 0 0 1 2.5V10h14V2.5A1.5 1.5 0 0 0 13.5 1H8.809z" />
                                            <path fill-rule="evenodd"
                                                d="M.5 11a.5.5 0 0 0 0 1h2.86l-.845 3.379a.5.5 0 0 0 .97.242L3.89 14h8.22l.405 1.621a.5.5 0 0 0 .97-.242L12.64 12h2.86a.5.5 0 0 0 0-1zm3.64 2 .25-1h7.22l.25 1z" />
                                        </svg>
                                    </i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Informasi Mitra</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Search input -->
        {{-- <div class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" id="searchInput" placeholder="&#xF002; Search...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div> --}}


        <div class="row ps-3 pe-3 justify-content-start gap-5">
            <!-- First Card -->
            @foreach ($data as $item)
                <div class="col-md-4 mb-4 p-0">
                    <div class="card p-0 ms-0 m-1" data-original-description="{{ $item['description'] }}">
                        <img src="{{ $item['poster'] }}" class="card-img-top" alt="..."
                            onerror="this.onerror=null;this.src='{{ asset('/') }}assets/images/nullsquare.jpg'">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['title'] }}</h5>
                            <p class="card-text" id="shortDescription">{{ Str::limit($item['description'], 30) }}</p>
                            <button type="button" class="detail-btn btn btn-primary" data-toggle="modal"
                                data-target="#fullInfoModal" data-mitra="{{ $item['mitra']['name'] }}"
                                data-title ="{{ $item['title'] }}" data-description="{{ $item['description'] }}">
                                View Full Info
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach


            <div class="col-md-4 mb-4 p-0" id="noResultsCard" style="display: none;">
                <div class="card p-0 ms-0 m-1">
                    <div class="card-body">
                        <h5 class="card-title">Data tidak ditemukan</h5>
                    </div>
                </div>
            </div>


        </div>

        <!-- Modal -->
        <div class="modal fade" id="fullInfoModal" tabindex="-1" role="dialog" aria-labelledby="fullInfoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fullInfoModalLabel">Full Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Perusahaan:</strong> <span id="perusahaan"></span></p>
                        <p><strong>Judul:</strong> <span id="title"></span></p>
                        <p><strong>Deskripsi:</strong> <span id="description"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ... (previous HTML code) ... -->

        <script>
            $(document).ready(function() {
                $(document).on('click', '.detail-btn', function() {

                    $('#perusahaan').text($(this).data('mitra'));
                    $('#title').text($(this).data('title'));
                    $('#description').text($(this).data('description'));
                })
            });
        </script>

    </div>
@endsection
