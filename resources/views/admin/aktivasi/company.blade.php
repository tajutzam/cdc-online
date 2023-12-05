@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0" style="background-color:white">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i><i><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                                                </svg></i></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Pengajuan Perusahaan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Logo</th>
                                        <th>Nama Perusahaan</th>
                                        <th>NIB</th>
                                        <th>Surat Izin Usaha</th>
                                        <th>No Telepon</th>
                                        <th>Alamat Perusahaan</th>
                                        <th>Email</th>

                                        <th>Perizinan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>No</td>
                                        <td><img src="" alt="logo-perusahaan"></td>
                                        <td>Nama Perusahaan</td>
                                        <td>NIB</td>
                                        <td><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5" />
                                                <path
                                                    d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                                            </svg></td>
                                        <td>No Telepon</td>
                                        <td>Alamat Perusahaan</td>
                                        <td>Email</td>

                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href=""><button type="button"
                                                        class="btn btn-success me-3 mb-3">Setujui</button></a>
                                                <a href=""> <button type="button"
                                                        class="btn btn-danger">Tolak</button></a>

                                            </div>
                                        </td>

                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
