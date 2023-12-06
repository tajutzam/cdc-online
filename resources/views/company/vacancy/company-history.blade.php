@extends('layouts-company.app')

@section('content')
    <div class="container-fluid">

        <div class="mt-4">
            <div class="col p-0">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                            <li class="breadcrumb-item"><a href=""><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" class="bi bi-hourglass-bottom"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5m2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702s.18.149.5.149.5-.15.5-.15v-.7c0-.701.478-1.236 1.011-1.492A3.5 3.5 0 0 0 11.5 3V2z" />
                                    </svg></i></a>
                            </li>

                            <li class="breadcrumb-item active" aria-current="page">Riwayat Lowongan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-body p-0">
                <div class="row ps-3">
                    <button class="btn btn-outline-primary btn-sm mb-3 w-auto m-3 " data-bs-toggle="modal"
                        data-bs-target="#my-modal"> <i class="fas fa-plus"></i>Tambah
                        Lowongan</button>
                </div>
            </div>
        </div> --}}

        <div class="table-responsive card p-2">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>

                        <th>Posisi</th>
                        <th>Deskripsi</th>
                        <th>Poster</th>
                        <th>Tautan</th>

                        <th>Kadaluwarsa</th>
                        <th>Diunggah</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>No</td>

                        <td>Frontend</td>
                        <td>Hayo kerja g lu</td>
                        <td>
                            <img src="" alt="" style="height: 100px; "
                                onerror="this.onerror=null;this.src='{{ asset('/') }}assets/images/nullsquare.jpg'">
                        </td>

                        <td style="text-align: center"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                fill="currentColor" class="bi bi-folder-symlink-fill" viewBox="0 0 16 16">
                                <path
                                    d="M13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3M2.19 3c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293L7.586 3H2.19m9.608 5.271-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742" />
                            </svg></td>

                        <td>Kadaluwarsa</td>
                        <td>17 agustus 1020</td>
                        <td><img src="" alt="bukti pembayaran"></td>
                        <td style="text-align: center">
                            <span class="badge badge-success">Disetujui</span>
                        </td>
                    </tr>
                    <tr>
                        <td>No</td>

                        <td>Frontend</td>
                        <td>Hayo kerja g lu</td>
                        <td>
                            <img src="" alt="" style="height: 100px; "
                                onerror="this.onerror=null;this.src='{{ asset('/') }}assets/images/nullsquare.jpg'">
                        </td>

                        <td style="text-align: center"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                fill="currentColor" class="bi bi-folder-symlink-fill" viewBox="0 0 16 16">
                                <path
                                    d="M13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2l.04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3M2.19 3c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293L7.586 3H2.19m9.608 5.271-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742" />
                            </svg></td>

                        <td>Kadaluwarsa</td>
                        <td>17 agustus 1020</td>
                        <td><img src="" alt="bukti pembayaran"></td>
                        <td style="text-align: center">
                            <span class="badge badge-danger">Ditolak</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
