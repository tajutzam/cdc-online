@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="mt-4">
                <div class="col p-0">
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                                <li class="breadcrumb-item"><a href="{{ route('quisioner-index') }}"><i
                                            class="bx bxs-book-open"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('quisioner-index') }}">Kuesioner</a>
                                <li class="breadcrumb-item active" aria-current="page">Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 pb-2 text-start">
                <h2> Data Pribadi </h2> <span class="badge text-bg-success"> Level
                    {{ $data['quisioner_level'][0]['level'] }} Bulan</span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 ">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content">
                            <div class="col-sm-6 text-start p-2">
                                <h4 style="margin: 0%">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    </svg>
                                    {{ $data['fullname'] }}
                                </h4>
                            </div>
                            <div class="col-sm-6 text-end">
                                <button class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="col">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-primary" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#section1" role="tab"
                                        aria-selected="true">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class='bx bx-user font-18 me-1'></i>
                                            </div>
                                            <div class="tab-title">Data Pribadi</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#section2" role="tab"
                                        aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class='bx bxs-user-badge font-18 me-1'></i>
                                            </div>
                                            <div class="tab-title">
                                                Kuesioner Utama</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#section3" role="tab"
                                        aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class='bx bxs-book-open font-18 me-1'></i>
                                            </div>
                                            <div class="tab-title">Studi Lanjut</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#section4" role="tab"
                                        aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class='bx bxs-badge font-18 me-1'></i>
                                            </div>
                                            <div class="tab-title">Level Kompetensi</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#section5" role="tab"
                                        aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class='bx bx-search font-18 me-1'></i>
                                            </div>
                                            <div class="tab-title">Metode Pembelajaran</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#section6" role="tab"
                                        aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class='bx bxs-paper-plane font-18 me-1'></i>
                                            </div>
                                            <div class="tab-title">Lowongan Pekerjaan</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#section7" role="tab"
                                        aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class='bx bx-grid-alt font-18 me-1'></i>
                                            </div>
                                            <div class="tab-title">Pekerjaan</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#section8" role="tab"
                                        aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class='bx bx-check-square font-18 me-1'></i>
                                            </div>
                                            <div class="tab-title">Lamaran ke Perusahaan</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#section9" role="tab"
                                        aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><i class='bx bxs-up-arrow-alt font-18 me-1'></i>
                                            </div>
                                            <div class="tab-title">
                                                Kesesuaian Pekerjaan</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content py-3">
                                <div class="tab-pane fade show active" id="section1" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table1" class="table table-striped table-bordered"
                                            style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Kode Pertanyaan</th>
                                                    <th>Jawaban</th>
                                                    <th>
                                                        Aksi
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($data['quisioner_level'][0]['identity']))
                                                    @foreach ($data['quisioner_level'][0]['identity'] as $key => $item)
                                                        <tr>
                                                            <td>{{ $key }}</td>
                                                            <td>{{ $item }}</td>
                                                            <td>
                                                                <div class="col-6 ">
                                                                    <a href="" class="update-detail-btn"
                                                                        data-bs-target="#update-detail"
                                                                        data-bs-toggle="modal"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: #005eff;"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="section2" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table2" class="table table-striped table-bordered"
                                            style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Kode Pertanyaan</th>
                                                    <th>Jawaban</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($data['quisioner_level'][0]['main']))
                                                    @foreach ($data['quisioner_level'][0]['main'] as $key => $item)
                                                        <tr>
                                                            <td>{{ $key }}</td>
                                                            <td>{{ $item }}</td>
                                                            <td>
                                                                <div class="col-6 ">
                                                                    <a href="" class="update-detail-btn"
                                                                        data-bs-target="#update-detail"
                                                                        data-bs-toggle="modal"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: #005eff;"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="section3" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table3" class="table table-striped table-bordered"
                                            style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Kode Pertanyaan</th>
                                                    <th>Jawaban</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($data['quisioner_level'][0]['furthe_study']))
                                                    @foreach ($data['quisioner_level'][0]['furthe_study'] as $key => $item)
                                                        <tr>
                                                            <td>{{ $key }}</td>
                                                            <td>{{ $item }}</td>
                                                            <td>
                                                                <div class="col-6 ">
                                                                    <a href="" class="update-detail-btn"
                                                                        data-bs-target="#update-detail"
                                                                        data-bs-toggle="modal"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: #005eff;"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="section4" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table4" class="table table-striped table-bordered"
                                            style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Kode Pertanyaan</th>
                                                    <th>Jawaban</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($data['quisioner_level'][0]['competence']))
                                                    @foreach ($data['quisioner_level'][0]['competence'] as $key => $item)
                                                        <tr>
                                                            <td>{{ $key }}</td>
                                                            <td>{{ $item }}</td>
                                                            <td>
                                                                <div class="col-6 ">
                                                                    <a href="" class="update-detail-btn"
                                                                        data-bs-target="#update-detail"
                                                                        data-bs-toggle="modal"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: #005eff;"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="section5" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table5" class="table table-striped table-bordered"
                                            style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Kode Pertanyaan</th>
                                                    <th>Jawaban</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($data['quisioner_level'][0]['studymethod']))
                                                    @foreach ($data['quisioner_level'][0]['studymethod'] as $key => $item)
                                                        <tr>
                                                            <td>{{ $key }}</td>
                                                            <td>{{ $item }}</td>
                                                            <td>
                                                                <div class="col-6 ">
                                                                    <a href="" class="update-detail-btn"
                                                                        data-bs-target="#update-detail"
                                                                        data-bs-toggle="modal"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: #005eff;"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="section6" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table" class="table table-striped table-bordered"
                                            style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Kode Pertanyaan</th>
                                                    <th>Jawaban</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($data['quisioner_level'][0]['startsearchjobs']))
                                                    @foreach ($data['quisioner_level'][0]['startsearchjobs'] as $key => $item)
                                                        <tr>
                                                            <td>{{ $key }}</td>
                                                            <td>{{ $item }}</td>
                                                            <td>
                                                                <div class="col-6 ">
                                                                    <a href="" class="update-detail-btn"
                                                                        data-bs-target="#update-detail"
                                                                        data-bs-toggle="modal"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: #005eff;"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="section7" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table7" class="table table-striped table-bordered"
                                            style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Kode Pertanyaan</th>
                                                    <th>Jawaban</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($data['quisioner_level'][0]['howtofindjobs']))
                                                    @foreach ($data['quisioner_level'][0]['howtofindjobs'] as $key => $item)
                                                        <tr>
                                                            <td>{{ $key }}</td>
                                                            <td>{{ $item }}</td>
                                                            <td>
                                                                <div class="col-6 ">
                                                                    <a href="" class="update-detail-btn"
                                                                        data-bs-target="#update-detail"
                                                                        data-bs-toggle="modal"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: #005eff;"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="section8" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table8" class="table table-striped table-bordered"
                                            style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Kode Pertanyaan</th>
                                                    <th>Jawaban</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($data['quisioner_level'][0]['companyapplied']))
                                                    @foreach ($data['quisioner_level'][0]['companyapplied'] as $key => $item)
                                                        <tr>
                                                            <td>{{ $key }}</td>
                                                            <td>{{ $item }}</td>
                                                            <td>
                                                                <div class="col-6 ">
                                                                    <a href="" class="update-detail-btn"
                                                                        data-bs-target="#update-detail"
                                                                        data-bs-toggle="modal"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: #005eff;"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="section9" role="tabpanel">
                                    <div class="table-responsive">
                                        <table id="table9" class="table table-striped table-bordered"
                                            style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th>Kode Pertanyaan</th>
                                                    <th>Jawaban</th>
                                                    <th>Aksi</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($data['quisioner_level'][0]['jobsuitability']))
                                                    @foreach ($data['quisioner_level'][0]['jobsuitability'] as $key => $item)
                                                        <tr>
                                                            <td>{{ $key }}</td>
                                                            <td>{{ $item }}</td>
                                                            <td>
                                                                <div class="col-6 ">
                                                                    <a href="" class="update-detail-btn"
                                                                        data-bs-target="#update-detail"
                                                                        data-bs-toggle="modal"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: #005eff;"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <x-modal-large id="update-detail" footer="footer" title="title" body="body">
        <x-slot name="title">Perbarui Nama Section</x-slot>
        <x-slot name="id">update-detail</x-slot>
        <x-slot name="body">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-floating mb-3">
                    <input type="text" readonly class="form-control form-control-sm" required id="id_update"
                        name=""></input>
                    <label for="floatingTextarea">Kode Pertanyaan</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea type="text" class="form-control form-control-sm" required id="nama_program_update" name=""></textarea>
                    <label for="floatingTextarea">Jawaban</label>
                </div>
                <div class="row justify-content-end">
                    <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                        data-bs-dismiss="modal">Tutup</button>
                    <button class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                </div>
            </form>
        </x-slot>
    </x-modal-large>
    <script>
        $(document).ready(function() {
            // Initialize DataTables for all 9 tables
            for (var i = 1; i <= 9; i++) {
                $('#table' + i).DataTable({
                    // Opsi yang bisa Anda tambahkan
                    searching: true, // Aktifkan opsi pencarian
                    lengthChange: true, // Aktifkan opsi filter jumlah data per halaman
                    paging: true, // Aktifkan opsi pagination
                    // Tambahkan opsi lain sesuai kebutuhan
                });
            }
        });

        const tabTitles = document.querySelectorAll('.tab-title');

        // Mendapatkan elemen h2 yang akan diubah
        const h2Element = document.querySelector('.col-sm-12 h2');

        // Menambahkan event listener ke setiap tab-title
        tabTitles.forEach(tabTitle => {
            tabTitle.addEventListener('click', function() {
                // Mendapatkan teks dari tab-title yang diklik
                const tabText = this.innerText.trim();

                // Mengganti teks di h2 dengan teks dari tab-title yang diklik
                h2Element.innerText = tabText;
            });
        });
    </script>
@endsection
