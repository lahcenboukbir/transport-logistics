@extends('layouts.app')

@section('link')
@endsection

@section('page-title')
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Custom DataLabels Bar</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="custom_datalabels_bar" class="apex-charts" dir="ltr"></div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script>
        var options = {
            series: [{
                data: [{{$new_prospects}}, {{$interested_prospects}}, {{$not_interested_prospects}}, {{$customer_prospects}}]
            }],
            chart: {
                type: "bar",
                height: 350,
                toolbar: {
                    show: !1
                }
            },
            plotOptions: {
                bar: {
                    barHeight: "100%",
                    distributed: !0,
                    horizontal: !0,
                    dataLabels: {
                        position: "bottom"
                    },
                },
            },
            colors: ['#405189', '#f7b84b', '#f06548', '#0ab39c'],
            dataLabels: {
                enabled: !0,
                textAnchor: "start",
                style: {
                    colors: ["#fff"]
                },
                formatter: function(t, e) {
                    return e.w.globals.labels[e.dataPointIndex] + ":  " + t;
                },
                offsetX: 0,
                dropShadow: {
                    enabled: !1
                },
            },
            stroke: {
                width: 1,
                colors: ['#fff']
            },
            xaxis: {
                categories: ['Nouveau', 'Intéressé', 'Pas intéressé', 'Client'],
            },
            yaxis: {
                labels: {
                    show: !1
                }
            },
            title: {
                text: "Custom DataLabels",
                align: "center",
                floating: !0,
                style: {
                    fontWeight: 500
                },
            },
            subtitle: {
                text: "Category Names as DataLabels inside bars",
                align: "center",
            },
            tooltip: {
                theme: "dark",
                x: {
                    show: !1
                },
                y: {
                    title: {
                        formatter: function() {
                            return "";
                        },
                    },
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#custom_datalabels_bar"), options);
        chart.render();
    </script>
@endsection
