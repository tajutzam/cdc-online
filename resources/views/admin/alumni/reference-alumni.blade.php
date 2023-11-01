@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
            <div class="text-white">{{ $errors->first() }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="">
                                <p class="mb-1 text-secondary">Total Alumni</p>
                                <h4 class="mb-0">{{ sizeof($data) }}</h4>
                            </div>
                            <div class="ms-auto">
                                <p class="mb-0 font-13 " style="color: #0dcaf0">+{{ $added_one_week }} Alumni</p>
                                <p class="mb-0 font-13 text-secondary">Dari Minggu Lalu</p>
                            </div>
                        </div>
                        <div id="alumni-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-database" viewBox="0 0 16 16">
                                        <path
                                            d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698ZM14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13V4Zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698Zm0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525Z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Referensi Alumni</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="row justify-content-start">
                        <div class="col">
                            <form action="{{ route('reference-alumni-update') }}" method="post">
                                @method('put')
                                <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target=""
                                    type="submit"> <i class="fas fa-sync-alt"></i>Perbarui</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Program Studi</th>
                                        <th>Email</th>
                                        <th>Tahun Lulus</th>
                                        <th>Tahun Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($data['alumni'] as $item) --}}
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item['nim'] }}</td>
                                            <td>{{ $item['nama_lengkap'] }}</td>
                                            <td>{{ $item['program_studi'] }}</td>
                                            <td>{{ $item['email'] }}</td>
                                            <td>{{ $item['tahun_lulus'] }}</td>
                                            <td>{{ $item['angkatan'] }}</td>

                                        </tr>
                                    @endforeach
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(function() {
                var e = {
                    series: [{
                        name: "Total Alumni",
                        data: ["332 Alumni (Angkatan 2022)", "33 Alumni (Angkatan 2023)",
                            "22 Alumni (Angkatan 204)"
                        ]
                    }],
                    chart: {
                        type: "area",
                        height: 100,
                        toolbar: {
                            show: !1
                        },
                        zoom: {
                            enabled: !1
                        },
                        dropShadow: {
                            enabled: !1,
                            top: 3,
                            left: 14,
                            blur: 4,
                            opacity: .12,
                            color: "#0dcaf0"
                        },
                        sparkline: {
                            enabled: !0
                        }
                    },
                    markers: {
                        size: 0,
                        colors: ["#0dcaf0"],
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
                        width: 2,
                        curve: "smooth"
                    },
                    colors: ["#0dcaf0"],
                    xaxis: {
                        categories: ["2022", "2023", "2024"]
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
                new ApexCharts(document.querySelector("#alumni-chart"), e).render();
            });
        </script>
    </div>
@endsection
