@extends('layouts.app')

@section('content')
    <div class="container-fluid shadow-none bg-transparent">
        <div class="row">
            <div class="col-sm-12">
                <div class=" py-3">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <h4 class="mb-3 mb-md-0"> <i class="bx bx-home-alt"></i> Dashboard </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div id="chart-alumnimonth"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card radius-10">
                    <div class="card-body">
                        <div id="chart-register-user"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card radius-10">
                    <div class="card-body">
                        <div id="prodi-alumni"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gx-lg-2 gy-2">
            <div class="col-lg-8 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-0">Sebaran Alumni</h5>
                            </div>
                        </div>
                    </div>

                    <div class=" mb-0">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d32654820.88251219!2d117.88879999999999!3d-2.4456499999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c4c07d7496404b7%3A0xe37b4de71badf485!2sIndonesia!5e0!3m2!1sen!2sid!4v1698663949011!5m2!1sen!2sid"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="card-footer mb-3">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0" style="color: grey"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-0">Alumni Terpopuler</h5>
                            </div>
                        </div>
                    </div>

                    <div class="customers-list p-3 mb-3">
                        @foreach ($topFollowers as $item)
                            <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                                <div class="">
                                    <img src="{{ $item['foto'] }}" class="rounded-circle" width="46" height="46"
                                        alt="" />
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-1 font-14">{{ $item['fullname'] }}</h6>
                                    <p class="mb-0 font-13 text-secondary">
                                        @if (isset($item['job']))
                                            {{ $item['job'] }} di {{ $item['company'] }}
                                        @else
                                            Belum Bekerja
                                        @endif
                                    </p>
                                </div>
                                <div class="list-inline d-flex customers-contacts ms-auto">
                                    <h6>{{ $item['total_followers'] }} Pengikut</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-1">Top Gaji Alumni</h5>
                                {{-- <p class="mb-0 font-13 text-secondary"><i class='bx bxs-calendar'></i>in last 30
                                    days revenue</p> --}}
                            </div>
                        </div>
                        <div class="table-responsive mt-4">
                            <table class="table align-middle mb-0 table-hover" id="Transaction-History">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Perusahaan</th>
                                        <th>Gaji</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topSalary as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <img src="{{ $item['image'] }}" class="rounded-circle"
                                                            width="46" height="46" alt="" />
                                                    </div>
                                                    <div class="ms-2">
                                                        <h6 class="mb-1 font-14">{{ $item['fullname'] }}</h6>
                                                        <p class="mb-0 font-13 text-secondary">{{ $item['last_position'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item['company'] }}</td>
                                            <td>{{ number_format($item['highest_salary'], 0, '.', ',') }}</td>
                                            <td>
                                                @if ($item['account_status'])
                                                    <div class="badge rounded-pill bg-success w-100">Terverifikasi</div>
                                                @else
                                                    <div class="badge rounded-pill bg-danger w-100">Belum Terverifikasi
                                                    </div>
                                                @endif
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
            var options = {
                series: [{
                    name: '0 Bulan',
                    data: {!! json_encode($lastFive['zero']) !!}
                }, {
                    name: '6 Bulan',
                    data: {!! json_encode($lastFive['six']) !!}
                }, {
                    name: '12 Bulan',
                    data: {!! json_encode($lastFive['twelve']) !!}
                }],
                chart: {
                    foreColor: '#9ba7b2',
                    height: 360,
                    type: 'area',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: true
                    },
                },
                colors: ["#17a00e", '#f41127', '#ffc107'],
                title: {
                    text: 'Alumni Mulai Bekerja',
                    align: 'left',
                    style: {
                        fontSize: "20px",
                        color: '#666',
                        fontWeight: 'normal'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'year',
                    categories: {!! json_encode($lastFive['categories']) !!}
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };
            var chart = new ApexCharts(document.querySelector("#chart-alumnimonth"), options);
            chart.render();
        });
    </script>
    <script>
        $(function() {
            Highcharts.chart("prodi-alumni", {
                chart: {
                    height: 350,
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: !1,
                    type: "pie",
                    styledMode: !0
                },
                credits: {
                    enabled: !1
                },
                title: {
                    text: "Total Alumni Program Studi"
                },
                subtitle: {
                    text: "Sebaran Jumlah Alumni per Program Studi"
                },
                tooltip: {
                    pointFormat: "{series.name}: <b>{point.y}</b>"
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: !0,
                        cursor: "pointer",
                        innerSize: 120,
                        dataLabels: {
                            enabled: !0,
                            format: "<b>{point.name}</b>: {point.y} "
                        },
                        showInLegend: !0
                    }
                },
                series: [{
                    name: "Users",
                    colorByPoint: !0,
                    data: {!! json_encode($totalPerStudyProgram) !!}
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            plotOptions: {
                                pie: {
                                    innerSize: 140,
                                    dataLabels: {
                                        enabled: !1
                                    }
                                }
                            }
                        }
                    }]
                }
            })
        });
    </script>
    <script>
        $(function() {
            Highcharts.chart("chart-register-user", {
                chart: {
                    height: 350,
                    type: "column",
                    styledMode: !0
                },
                credits: {
                    enabled: !1
                },
                title: {
                    text: "Perkembangan Pendaftar Apilkasi"
                },
                accessibility: {
                    announceNewData: {
                        enabled: !0
                    }
                },
                xAxis: {
                    type: "category"
                },
                yAxis: {
                    title: {
                        text: "Total Pendaftar Aplikasi"
                    },
                },
                subtitle: {
                    text: "Total : {{ $total }} Pengguna"
                },
                legend: {
                    enabled: !1
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: !0,
                            format: "{point.y}"
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
                },
                series: [{
                    name: "Jumlah Pendaftar",
                    colorByPoint: true,
                    data: {!! json_encode($enrollProgres) !!}
                }],
            })
        });
    </script>
@endsection
