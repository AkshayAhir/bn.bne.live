@extends('admin.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/css/daterange-picker.css')}}">
@endsection
@section('content')
    <div class="container" style="max-width: 100% !important;">
        <div class="row" style="padding-left: 15px;">
            <h4>Dashboard</h4>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-md-6 col-sm-12 mt-4">
                        <div class="card total_card">
                            <p style="margin-bottom: 6px;">Total Tickets Sold in <b>{{date('M')}}</b></p>
                            <h2 style="font-weight: 600;">{{$total_tickets_sold[0]->total_sold}}</h2>
                            <!--<h6 style="padding-top: 10px;">{{date('M')}}</h6>-->
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 mt-4">
                        <div class="card total_card">
                            <p style="margin-bottom: 6px;">Total Revenue Generated in <b>{{date('M')}}</b></p>
                            <h2 style="font-weight: 600;">৳{{$total_tickets_sold[0]->total_revenue}}</h2>
                            <!--<h6 style="padding-top: 10px;">{{date('M')}}</h6>-->
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="card">
                            <div class="row sales-overview">
                                <div class="col-md-6">
                                    <div class="sales-overview">
                                        <h6>Sales Overview</h6>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Select date</label>
                                    <input class="form-control digits" id="reportrange" type="text">
                                </div>
                            </div>

                            <div class="card-body">
                                <canvas id="sales-overview"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 ">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mt-4">
                        <div class="card">
                            <div class="row sales-overview">
                                <div class="col-md-12 col-sm-12">
                                    <div class="sales-overview">
                                        <h6>Popular Event</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-striped" style="width: 100%">
                                    <thead>
                                    <th>Event Title</th>
                                    <th>Date</th>
                                    <th>Total Tickets</th>
                                    <th>Sold Ticket</th>
                                    </thead>
                                    <tbody>
                                    @foreach($popular_event as $popular_events)
                                        <tr>
                                            <td>{{$popular_events['event']['event_name']}}</td>
                                            <td>{{$popular_events['event']['event_date']}}</td>
                                            <td>{{$popular_events['total_tickets']}}</td>
                                            <td>{{$popular_events['total_sold']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="card">
                            <div class="row sales-overview">
                                <div class="col-md-12 col-sm-12">
                                    <div class="sales-overview">
                                        <h6>List of events</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-striped" style="width: 100%">
                                    <thead>
                                    <th>Event Name</th>
                                    <th>Total Ticket Sold</th>
                                    <th>Total Ticket Available</th>
                                    <th>Total Revenue Generated</th>
                                    </thead>
                                    <tbody>
                                    @foreach($list_of_event as $list_of_events)
                                        <tr>
                                            <td>{{$list_of_events['event_name']}}</td>
                                            <td>{{$list_of_events['total_sold']}}</td>
                                            <td>{{$list_of_events['avail_seats']}}</td>
                                            <td>৳{{$list_of_events['total_revenue']}}</td>
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
    </div>
@endsection
@section('scripts')
    <!-- Plugins JS start-->
    <script src="{{asset('admin/assets/js/moment.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/daterangepicker.js')}}"></script>
    <script src="{{asset('admin/assets/js/daterange-picker.custom.js')}}"></script>
    <!-- Plugins JS Ends-->
    <script>
        $('#reportrange').on('change', function () {
            var date = $('#reportrange').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ url('admin/dateChange') }}",
                data: { date: date },
                success: function (response) {
                    var ctx = document.getElementById('sales-overview').getContext('2d');
                    var chartInstance = Chart.getChart(ctx);

                    if (chartInstance) {
                        chartInstance.destroy();
                    }

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: $.map(response, function (item) {
                                return item.date;
                            }),
                            datasets: [{
                                label: 'Total sales',
                                data: response.map(function (item) {
                                    return item.sum_data;
                                }),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Total sales (৳)'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Days'
                                    }
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
