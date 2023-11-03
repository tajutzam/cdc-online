@extends('layouts.app')

@section('content')

    <body>
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                    <div class="text-white">{{ $errors->first() }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Alumni Yang Mengisi Quisioner</p>
                                    <h4 class="my-1">{{ $data['filled'] }}</h4>
                                </div>

                                {{-- <div class="ms-auto">
                                    <p class="mb-0 font-13 text-success ">+12 Alumni Terverifikasi <i
                                            class='bx bxs-pencil font-20'></i>
                                    </p>
                                    <p class="mb-0 font-13 text-secondary">Dari Minggu Lalu</p>
                                </div> --}}
                            </div>
                            <div id="verify-chart-quesioner"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Alumni Belum Mengisi Quisioner</p>
                                    <h4 class="my-1">{{ $data['blank'] }}</h4>
                                </div>

                                {{-- <div class="ms-auto">
                                    <p class="mb-0 font-13 text-danger ">+12 Alumni Tidak Terverifikasi <i
                                            class='bx bxs-pencil font-20'></i>
                                    </p>
                                    <p class="mb-0 font-13 text-secondary">Dari Minggu Lalu</p>
                                </div> --}}
                            </div>
                            <div id="not-verify-chart-quesioner"></div>
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
                                <li class="breadcrumb-item active" aria-current="page">Kuesioner</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Angkatan
                                </button>
                                <ul class="dropdown-menu">
                                    <?php
                                    $currentYear = date('Y');
                                    for ($i = 0; $i < 5; $i++) {
                                        $year = $currentYear - $i;
                                        echo '<li><a class="dropdown-item tahun" href="#" data-year="' . $year . '">' . $year . '</a></li>';
                                        if ($i < 4) {
                                            echo '<li><hr class="dropdown-divider"></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>

                            <div id="btn-hover" class="btn-group" role="group" aria-label="Basic mixed styles example"
                                style="padding: 1%">
                                <!-- Tombol-tombol dengan tautan -->
                                <button type="button" class="btn btn-outline-danger text-danger" id="bulan-0">
                                    <a href="?bulan=0" style="text-decoration: none;">0 Bulan</a>
                                </button>

                                <button type="button" class="btn btn-outline-warning text-warning" id="bulan-6">
                                    <a href="?bulan=6" style="text-decoration: none;">6 Bulan</a>
                                </button>

                                <button type="button" class="btn btn-outline-success" id="bulan-12">
                                    <a href="?bulan=12" style="text-decoration: none;">12 Bulan</a>
                                </button>

                                <style>
                                    button a {
                                        color: inherit;
                                        /* Warna teks menjadi putih saat tombol di-hover */
                                    }

                                    /* Aturan CSS untuk mengatur tautan saat tombol di-hover */
                                    button:hover a {
                                        color: white;
                                        /* Warna teks menjadi putih saat tombol di-hover */
                                    }
                                </style>

                            </div>
                        </div>

                        <div class="col-md-6 text-md-end">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example"
                                style="padding: 1%">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#export-pdf">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0z" />
                                    </svg> Export PDF
                                </button>
                                <!-- Example single danger button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#export" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 16 16">
                                            <path
                                                d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z" />
                                        </svg> Export Excel
                                    </button>
                                </div>

                                <button type="button" class="btn btn-secondary" data-bs-target="#upload-excel"
                                    data-bs-toggle="modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                        <path
                                            d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707V11.5z" />
                                        <path
                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                    </svg> Haluskan
                                </button>
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
                                <table id="example"
                                    class="table table-striped table-bordered table-hover table-condensed"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Program Studi</th>
                                            <th>Email</th>
                                            <th>Foto</th>
                                            <th>Tahun Masuk</th>
                                            <th>Tahun Lulus</th>
                                            <th>Status</th>
                                            <th style="text-align: center">Detail</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data['quisioners'] as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item['fullname'] }}</td>
                                                <td>{{ $item['prodi']['nama_prodi'] }}</td>
                                                <td>{{ $item['email'] }}</td>
                                                <td><img style="max-height: 50px" class="img-fluid"
                                                        src="{{ $item['foto'] }}" alt="foto_user"></td>
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
                                                    <div class="dropdown px-3" class="text-center">
                                                        <a class="d-flex align-items-center nav-link  gap-3 dropdown-toggle-nocaret"
                                                            href="#" role="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="btn btn-success">Detail</button>
                                                                <button type="button"
                                                                    class="btn btn-success dropdown-toggle dropdown-toggle-split"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false"></button>
                                                            </div>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end ">
                                                            @foreach ($item['quisioner'] as $itemQuisioner)
                                                                <li><a class="dropdown-item d-flex align-items-center"
                                                                        href="{{ route('detail-quisioner', ['level' => $itemQuisioner['level'], 'userId' => $item['id']]) }}"><i></i><span>Level
                                                                            {{ $itemQuisioner['level'] }} </span></a>
                                                                </li>
                                                            @endforeach
                                                            <li>
                                                                <div class="dropdown-divider mb-0"></div>
                                                            </li>
                                                        </ul>
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


        <x-modal-small id="export" footer="footer" title="title" body="body">
            <x-slot name="title">Export To Excel</x-slot>
            <x-slot name="id">export</x-slot>
            <x-slot name="body">
                <form action="{{ route('export') }}" method="post">
                    <label for="tahun-level-excel">Tahun Level Quisioner</label>
                    <select class="form-select form-select-sm mb-3" aria-label="Large select example" name="tahun" id="tahun-level-excel">
                        @php
                            $currentYear = date('Y');
                        @endphp
                        @for ($i = 0; $i < 5; $i++)
                            <optgroup label="{{ $currentYear - $i }}">
                                <option value="{{ $currentYear - $i }}-0">0 Bulan</option>
                                <option value="{{ $currentYear - $i }}-6">6 Bulan</option>
                                <option value="{{ $currentYear - $i }}-12">12 Bulan</option>
                            </optgroup>
                        @endfor
                    </select>
                    <select class="form-select" name="format" multiple aria-label="Multiple select example">
                        <option selected>Pilih Format Export</option>
                        <option value="xlsx" class="text-body-emphasis">Xlxs</option>
                        <option value="csv">Csv</option>
                    </select>
                    <div class="row justify-content-end">
                        <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                            data-bs-dismiss="modal">Tutup</button>
                        <button class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                    </div>
                </form>
            </x-slot>
        </x-modal-small>


        <x-modal-small id="export-pdf" footer="footer" title="title" body="body">
            <x-slot name="title">Export To PDF</x-slot>
            <x-slot name="id">export-pdf</x-slot>
            <x-slot name="body">
                <form action="{{ route('export-pdf') }}" method="post">
                    <label for="tahun-bulan">Tahun Level Quisioner</label>
                    <select class="form-select form-select-sm mb-3" aria-label="Large select example" name="tahun"
                        id="tahun-bulan">
                        @php
                            $currentYear = date('Y');
                        @endphp
                        @for ($i = 0; $i < 5; $i++)
                            <optgroup label="{{ $currentYear - $i }}">
                                <option value="{{ $currentYear - $i }}-0">0 Bulan</option>
                                <option value="{{ $currentYear - $i }}-6">6 Bulan</option>
                                <option value="{{ $currentYear - $i }}-12">12 Bulan</option>
                            </optgroup>
                        @endfor
                    </select>
                    <div class="row justify-content-end">
                        <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                            data-bs-dismiss="modal">Tutup</button>
                        <button class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                    </div>
                </form>
            </x-slot>
        </x-modal-small>



        <x-modal-small id="upload-excel" footer="footer" title="title" body="body">
            <x-slot name="title">Import Excel</x-slot>
            <x-slot name="id">upload-excel</x-slot>
            <x-slot name="body">
                <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                    <input type="file" name="excel" id="" accept=".xls, .xlsx" class="mb-3">
                    <div class="row justify-content-end mt-3">
                        <button class="col-3 btn btn-outline-danger btn-sm" type="reset"
                            data-bs-dismiss="modal">Tutup</button>
                        <button class="col-3 btn btn-outline-primary btn-sm mx-4">Simpan</button>
                    </div>
                </form>
            </x-slot>
        </x-modal-small>


        <script>
            $(function() {
                var e = {
                    series: [{
                        name: "Verify Quesioner",
                        data: {!! json_encode($data['countPerDay']) !!}
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
                            color: "#17a00e"
                        },
                        sparkline: {
                            enabled: !0
                        }
                    },
                    markers: {
                        size: 0,
                        colors: ["#17a00e"],
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
                    colors: ["#17a00e"],
                    xaxis: {
                        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                            "Dec"
                        ]
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
                new ApexCharts(document.querySelector("#verify-chart-quesioner"), e).render();
                var e = {
                    series: [{
                        name: "Not Verify Quesioner",
                        data: [332, 540, 160, 240, 160, 671, 355, 671, 414, 555, 257, 901, 613]
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
                            color: "#f41127"
                        },
                        sparkline: {
                            enabled: !0
                        }
                    },
                    markers: {
                        size: 0,
                        colors: ["#f41127"],
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
                    colors: ["#f41127"],
                    xaxis: {
                        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                            "Dec"
                        ]
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
                new ApexCharts(document.querySelector("#not-verify-chart-quesioner"), e).render();
            });
        </script>
        <script>
            $(document).ready(function() {
                // Tangani klik pada tombol bulan
                $('#bulan-0, #bulan-6, #bulan-12').on('click', function(e) {
                    e.preventDefault(); // Mencegah tindakan default tautan

                    // Dapatkan nilai bulan dari atribut id tombol
                    var bulan = $(this).attr('id').split('-')[1];

                    // Dapatkan nilai tahun dari parameter tahun jika ada, atau gunakan tahun default
                    var tahun = getParameterByName('tahun') || 'tahun-default';

                    // Redirect ke URL dengan parameter tahun dan bulan
                    if (tahun !== 'tahun-default') {
                        window.location.href = '?tahun=' + tahun + '&bulan=' + bulan;
                    } else {
                        window.location.href = '?bulan=' + bulan;
                    }
                });

                $('.tahun').on('click', function(e) {
                    e.preventDefault(); // Mencegah tindakan default tautan

                    // Dapatkan nilai tahun dari atribut data-year
                    var year = $(this).data('year');

                    // Redirect ke URL dengan parameter tahun
                    window.location.href = '?tahun=' + year;
                });

                // Fungsi untuk mendapatkan nilai parameter dari URL
                function getParameterByName(name, url) {
                    if (!url) url = window.location.href;
                    name = name.replace(/[\[\]]/g, "\\$&");
                    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                        results = regex.exec(url);
                    if (!results) return null;
                    if (!results[2]) return '';
                    return decodeURIComponent(results[2].replace(/\+/g, " "));
                }
            });
        </script>
    @endsection
