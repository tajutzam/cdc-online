@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Lowongan Aktif</p>
                                <h4 class="my-1">10</h4>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-badge'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Lowongan Tidak Aktif</p>
                                <h4 class="my-1">10</h4>
                            </div>
                            <div class="widgets-icons bg-light-primary text-primary ms-auto"><i class='bx bxs-badge'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i><i><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                                                    <path
                                                        d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z" />
                                                </svg></i></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Riwayat Lowongan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-success" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#aktif" role="tab"
                                    aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='me-1'><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    class="bi bi-calendar2-check-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zm9.954 3H2.545c-.3 0-.545.224-.545.5v1c0 .276.244.5.545.5h10.91c.3 0 .545-.224.545-.5v-1c0-.276-.244-.5-.546-.5zm-2.6 5.854a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                                                </svg></i>
                                        </div>
                                        <div class="tab-title">Aktif</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#nonaktif" role="tab"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='me-1'> <svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    class="bi bi-calendar-x-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6.854 8.146 8 9.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 1 1 .708-.708z" />
                                                </svg></i>
                                        </div>
                                        <div class="tab-title">Tidak Aktif</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content py-3">
                            <div class="tab-pane fade show active" id="aktif" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pengunggah</th>
                                                <th>Perusahaan</th>
                                                <th>Posisi</th>
                                                <th>Deskripsi</th>
                                                <th>Poster</th>
                                                <th>Diunggah</th>
                                                <th>Kedaluwarsa</th>
                                                <th>Tautan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($data as $item) --}}
                                            <tr class="text-start">
                                                <td>No</td>
                                                <td>Pengunggah</td>
                                                <td>Perusahaan</td>
                                                <td>Posisi</td>
                                                <td>Deskripsi</td>
                                                <td>Poster</td>
                                                <td>Diunggah</td>
                                                <td>Kedaluwarsa</td>
                                                <td>Tautan</td>
                                            </tr>
                                            {{-- @endforeach --}}
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nonaktif" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="example2" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pengunggah</th>
                                                <th>Perusahaan</th>
                                                <th>Posisi</th>
                                                <th>Deskripsi</th>
                                                <th>Poster</th>
                                                <th>Diunggah</th>
                                                <th>Kedaluwarsa</th>
                                                <th>Tautan</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="text-start">
                                                <td>No</td>
                                                <td>Pengunggah</td>
                                                <td>Perusahaan</td>
                                                <td>Posisi</td>
                                                <td>Deskripsi</td>
                                                <td>Poster</td>
                                                <td>Diunggah</td>
                                                <td>Kedaluwarsa</td>
                                                <td>Tautan</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-modal-small id="detail-user" footer="footer" title="title" body="body">
                <x-slot name="title">Detail Pengunggah <span id="level-uploader"></span></x-slot>
                <x-slot name="body">
                    <div></div>
                    <img id="img-uploader" class="rounded-circle mb-3  shadow-4-strong" alt="image-uploader" />

                    <div class="row mb-3">
                        <label for="input35" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input readonly type="text" class="form-control" id="email-user"
                                placeholder="Enter Your Name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="input36" class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input readonly type="text" class="form-control" id="fullname-user"
                                placeholder="Phone No">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="input37" class="col-sm-3 col-form-label">NIM / NPWP</label>
                        <div class="col-sm-9">
                            <input readonly type="email" class="form-control" id="nim-user"
                                placeholder="Email Address">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="input37" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input readonly type="email" class="form-control" id="address-user"
                                placeholder="Email Address">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="input37" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <input readonly type="email" class="form-control" id="gender-user"
                                placeholder="Email Address">
                        </div>
                    </div>
                </x-slot>
            </x-modal-small>
            <script>
                $(document).ready(function() {
                    $('#example2').DataTable(); // Ini adalah untuk tabel "Tidak Aktif"
                });
            </script>
        @endsection
