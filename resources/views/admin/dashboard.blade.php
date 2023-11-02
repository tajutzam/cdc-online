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
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-3.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Emy Jackson</h6>
                                <p class="mb-0 font-13 text-secondary">Dosen di Politeknik </p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto">
                                <h6>1000 Pengikut</h6>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-3.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Emy Jackson</h6>
                                <p class="mb-0 font-13 text-secondary">Dosen di Politeknik </p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto">
                                <h6>1000 Pengikut</h6>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-3.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Emy Jackson</h6>
                                <p class="mb-0 font-13 text-secondary">Dosen di Politeknik </p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto">
                                <h6>1000 Pengikut</h6>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-3.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Emy Jackson</h6>
                                <p class="mb-0 font-13 text-secondary">Dosen di Politeknik </p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto">
                                <h6>1000 Pengikut</h6>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-3.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Emy Jackson</h6>
                                <p class="mb-0 font-13 text-secondary">Dosen di Politeknik </p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto">
                                <h6>1000 Pengikut</h6>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-3.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Emy Jackson</h6>
                                <p class="mb-0 font-13 text-secondary">Dosen di Politeknik </p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto">
                                <h6>1000 Pengikut</h6>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-3.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Emy Jackson</h6>
                                <p class="mb-0 font-13 text-secondary">Dosen di Politeknik </p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto">
                                <h6>1000 Pengikut</h6>
                            </div>
                        </div>
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
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="assets/images/avatars/avatar-1.png" class="rounded-circle"
                                                        width="46" height="46" alt="" />
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Sumariono</h6>
                                                    <p class="mb-0 font-13 text-secondary">Manager</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>PT Mayora Tbk.</td>
                                        <td>50.000.000</td>
                                        <td>
                                            <div class="badge rounded-pill bg-success w-100">Terverifikasi</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="">
                                                    <img src="assets/images/avatars/avatar-1.png" class="rounded-circle"
                                                        width="46" height="46" alt="" />
                                                </div>
                                                <div class="ms-2">
                                                    <h6 class="mb-1 font-14">Mariyono</h6>
                                                    <p class="mb-0 font-13 text-secondary">Dokter</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>RS Medika Sejahtera</td>
                                        <td>20.000.000</td>
                                        <td>
                                            <div class="badge rounded-pill bg-danger w-100">Belum Terverifikasi</div>
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

    <script>
        $(function() {
            var options = {
                series: [{
                    name: '0 Bulan',
                    data: [31, 40, 68, 31, 92]
                }, {
                    name: '6 Bulan',
                    data: [11, 82, 45, 80, 34]
                }, {
                    name: '12 Bulan',
                    data: [11, 82, 70, 80, 34]
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
                    categories: ["Angkatan 2019", " Angkatan 2020", "Angkatan 2021", "Angkatan 2022",
                        "Angkatan 2023"
                    ]
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
                    data: [{
                        name: "Manajemen Informatika",
                        y: 120
                    }, {
                        name: "Teknik Informatika",
                        y: 220
                    }, {
                        name: "Teknik Komputer",
                        y: 150
                    }]
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
                    text: "Total : 1000 Pengguna"
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
                    data: [{
                            name: "Januari",
                            y: 3,
                        },
                        {
                            name: "Februari",
                            y: 40,
                        },
                        {
                            name: "Maret",
                            y: 25,
                        },
                        {
                            name: "April",
                            y: 13,
                        },
                        {
                            name: "Mei",
                            y: 20,
                        },
                        {
                            name: "Juni",
                            y: 30,
                        },
                        {
                            name: "Juli",
                            y: 15,
                        },
                        {
                            name: "Agustus",
                            y: 10,
                        },
                        {
                            name: "September",
                            y: 18,
                        },
                        {
                            name: "Oktober",
                            y: 220,
                            colorByPoint: false,

                        },
                        {
                            name: "November",
                            y: 33,
                        },
                        {
                            name: "Desember",
                            y: 45,
                        },
                    ],
                }],

            })
        });
    </script>
    <script>
        var map;

        function initMap() {
            var map = new google.maps.Map(document.getElementById('style-map'), {
                center: {
                    lat: 40.674,
                    lng: -73.945
                },
                zoom: 12,
                styles: [{
                    elementType: 'geometry',
                    stylers: [{
                        color: '#242f3e'
                    }]
                }, {
                    elementType: 'labels.text.stroke',
                    stylers: [{
                        color: '#242f3e'
                    }]
                }, {
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#746855'
                    }]
                }, {
                    featureType: 'administrative.locality',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#d59563'
                    }]
                }, {
                    featureType: 'poi',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#d59563'
                    }]
                }, {
                    featureType: 'poi.park',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#263c3f'
                    }]
                }, {
                    featureType: 'poi.park',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#6b9a76'
                    }]
                }, {
                    featureType: 'road',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#38414e'
                    }]
                }, {
                    featureType: 'road',
                    elementType: 'geometry.stroke',
                    stylers: [{
                        color: '#212a37'
                    }]
                }, {
                    featureType: 'road',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#9ca5b3'
                    }]
                }, {
                    featureType: 'road.highway',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#746855'
                    }]
                }, {
                    featureType: 'road.highway',
                    elementType: 'geometry.stroke',
                    stylers: [{
                        color: '#1f2835'
                    }]
                }, {
                    featureType: 'road.highway',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#f3d19c'
                    }]
                }, {
                    featureType: 'transit',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#2f3948'
                    }]
                }, {
                    featureType: 'transit.station',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#d59563'
                    }]
                }, {
                    featureType: 'water',
                    elementType: 'geometry',
                    stylers: [{
                        color: '#17263c'
                    }]
                }, {
                    featureType: 'water',
                    elementType: 'labels.text.fill',
                    stylers: [{
                        color: '#515c6d'
                    }]
                }, {
                    featureType: 'water',
                    elementType: 'labels.text.stroke',
                    stylers: [{
                        color: '#17263c'
                    }]
                }]
            });
        }
    </script>
@endsection
