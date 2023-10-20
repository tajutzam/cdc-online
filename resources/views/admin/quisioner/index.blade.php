@extends('layouts.app')

@section('content')
    <div class="row gap-4">
        <div class="card radius-10 col-lg-3 col-md-4 col-sm-12 ">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Alumni Yang Mengisi Quisioner</p>
                        <h4 class="my-1">10</h4>
                    </div>
                    <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-pencil'></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card radius-10 col-lg-3 col-md-4 col-sm-12 ">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Alumni Yang Belum Mengisi Quisioner</p>
                        <h4 class="my-1">20</h4>
                    </div>
                    <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-pencil'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Kuesioner User</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card row align-items-start py-2 table-responsive">
        <table id="example" class="table table-striped table-bordered table-hover table-condensed" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Tahun Lulus</th>
                    <th>Tahun Masuk</th>
                    <th>Status</th>
                    <th style="text-align: center">Detail</th>

                </tr>
            </thead>
            @dd($data)
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item['fullname'] }}</td>
                        <td>{{ $item['prodi']['nama_prodi'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td><img style="height: 50px" class="" src="{{ $item['foto'] }}" alt="foto_user"></td>
                        <td>{{ $item['tahun_masuk'] }}</td>
                        <td>{{ $item['tahun_lulus'] }}</td>
                        <td class="text-center">
                            @if ($item['account_status'])
                                <i class="fa-solid fa-circle-check" style="color: #005eff;"></i>
                            @else
                                <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i>
                            @endif
                        </td>
                        <td>
                            <div class="user-box dropdown px-3" class="text-center">
                                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success">2/9</button>
                                        <button type="button"
                                            class="btn btn-success dropdown-toggle dropdown-toggle-s\plit"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        </button>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">

                                    <li><a class="dropdown-item d-flex align-items-center"
                                            href="quisioner/detail/{{ $item['id'] }}"><i></i><span>1</span></a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider mb-0"></div>
                                    </li>

                                </ul>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Tahun Lulus</th>
                    <th>Tahun Masuk</th>
                    <th>Status</th>
                    <th style="text-align: center">Detail</th>

                </tr>
            </tfoot>
        </table>
    </div>
@endsection
