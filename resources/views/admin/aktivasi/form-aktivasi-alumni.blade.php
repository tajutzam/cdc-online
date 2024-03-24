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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Menunggu</p>
                                <h4 class="my-1">{{ sizeof($data) }}</h4>
                            </div>
                            <div class="widgets-icons bg-light-black text-black ms-auto"><i class='bx bxs-user-account'></i>
                            </div>
                        </div>
                        <div id="waiting-list"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0" style="background-color:white">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i><i><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                    <path
                                                        d=" M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0
                                                                                                        1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5
                                                                                                        0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                    <path
                                                        d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                                                </svg></i></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Pengajuan Alumni</li>
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
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Jurusan</th>
                                        <th>Program Studi</th>
                                        <th>Ijazah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item['nim'] }}</td>
                                            <td>{{ $item['nama_lengkap'] }}</td>
                                            <th>{{ $item['email'] }}</th>
                                            <td>{{ $item['no_telp'] }}</td>
                                            <td>{{ $item['jurusan'] }}</td>
                                            <td>{{ $item['program_studi'] ?? '-' }}</td>
                                            <td><a target="_blank" href="{{ $item['ijazah'] }}"> <i
                                                        class="fas fa-file-alt"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic mixed styles example">
                                                    <form action="{{ route('acc-reject', ['id' => $item['id']]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <input type="text" name="case" value="reject" hidden>
                                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                                    </form>
                                                    <form action="{{ route('acc-reject', ['id' => $item['id']]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <input type="text" name="case" value="acc" hidden>
                                                        <button type="submit" class="btn btn-success">Terima</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            // chart 1
            var e = {
                series: [{
                    name: "Whatsapp",
                    data: {!! json_encode($countPerDay) !!}
                }],
                chart: {
                    type: "line",
                    height: 65,
                    toolbar: {
                        show: !1
                    },
                    zoom: {
                        enabled: !1
                    },
                    dropShadow: {
                        enabled: !0,
                        top: 3,
                        left: 14,
                        blur: 4,
                        opacity: .12,
                        color: "#000"
                    },
                    sparkline: {
                        enabled: !0
                    }
                },
                markers: {
                    size: 0,
                    colors: ["#000"],
                    strokeColors: "#fff",
                    strokeWidth: 2,
                    hover: {
                        size: 7
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    show: !0,
                    width: 3,
                    curve: "smooth"
                },
                colors: ["#000"],
                xaxis: {
                    categories: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    theme: "dark",
                    fixed: {
                        enabled: !1
                    },
                    x: {
                        show: !1
                    },
                    y: {
                        title: {
                            formatter: function(e) {
                                return ""
                            }
                        }
                    },
                    marker: {
                        show: !1
                    }
                }
            };
            new ApexCharts(document.querySelector("#waiting-list"), e).render();

        });
    </script>
@endsection
