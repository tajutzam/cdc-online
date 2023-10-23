@extends('layouts.app')

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-card-checklist"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                    <path
                                        d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                                </svg></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Pengajuan Alumni </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card row align-items-start" style="padding: 2%">
        <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jenjang</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Jurusan</th>
                    <th>Program Studi</th>
                    <th>Ijazah</th>
                    <th>Aksi</th>
                    {{-- <th>Detail Kuesioner</th> --}}

                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($data as $item) --}}
                <tr>
                    {{-- <td>{{ $loop->iteration }}</td> --}}
                    <td>No</td>
                    <td>Foto</td>
                    <td>NIM</td>
                    <td>Nama</td>
                    <th>Jenjang</th>
                    <td>Email</td>
                    <td>No Telepon</td>
                    <td>Jurusan</td>
                    <td>Program studi</td>
                    <td>Ijazah</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-danger">Tolak</button>

                            <button type="button" class="btn btn-success">Terima</button>
                        </div>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>

        </table>
    </div>
@endsection
