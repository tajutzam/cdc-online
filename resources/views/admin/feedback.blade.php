@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Pesan Masuk</p>
                                <h4 class="my-1">28</h4>
                            </div>
                            <div class="widgets-icons bg-light-primary text-primary ms-auto"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-envelope-paper-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6.5 9.5 3 7.5v-6A1.5 1.5 0 0 1 4.5 0h7A1.5 1.5 0 0 1 13 1.5v6l-3.5 2L8 8.75l-1.5.75ZM1.059 3.635 2 3.133v3.753L0 5.713V5.4a2 2 0 0 1 1.059-1.765ZM16 5.713l-2 1.173V3.133l.941.502A2 2 0 0 1 16 5.4v.313Zm0 1.16-5.693 3.337L16 13.372v-6.5Zm-8 3.199 7.941 4.412A2 2 0 0 1 14 16H2a2 2 0 0 1-1.941-1.516L8 10.072Zm-8 3.3 5.693-3.162L0 6.873v6.5Z" />
                                </svg>
                            </div>
                        </div>
                        <div id="feedback-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0" style="background-color: white">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Feedback</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- Gunakan Perulangan di col-sm-6 --}}
            <div class="col-sm-6">
                <div class="row pt-2">
                    <div class="col-sm">
                        <div class="card pb-0 mb-0" style="background-color: #007bff; border-radius: 10px 10px 0 0;">
                            <h5 class="p-2"
                                style="padding-inline-start: 10px; margin: 0; color: white; font-weight: bold; height:0%;">
                                <i class="fas fa-user"></i> Nama Pengguna
                            </h5>
                        </div>
                        <div class="card pt-0 mb-0">
                            <div class="card-body">
                                <p class="card-text">Ini adalah komentar yang ditulis oleh pengguna. Ini adalah contoh
                                    komentar yang panjang.</p>
                                <form class="mt-3">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Balas komentar..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <ul class="pagination justify-content-start pt-3">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Sebelumnya</a>
                </li>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Selanjutnya</a>
                </li>
            </ul>
        </nav>
    </div>

    <script>
        $(function() {
            // chart 1
            var e = {
                series: [{
                    name: "Feedback",
                    data: [240, 160, 671, 414, 555, 257, 901]
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
                        color: "#0d6efd"
                    },
                    sparkline: {
                        enabled: !0
                    }
                },
                markers: {
                    size: 0,
                    colors: ["#0d6efd"],
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
                colors: ["#0d6efd"],
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
            new ApexCharts(document.querySelector("#feedback-chart"), e).render();

        });
    </script>
@endsection
