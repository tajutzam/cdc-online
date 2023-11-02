@extends('prodi-layouts.app')

@section('content')
    <div class="container-fluid shadow-none bg-transparent">
        <div class="row">
            <div class="col-sm-12">
                <div class=" py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-3 mb-md-0"> <i class="bx bx-home-alt"></i> Program Studi [Nama Prodi] </h4>
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
@endsection
