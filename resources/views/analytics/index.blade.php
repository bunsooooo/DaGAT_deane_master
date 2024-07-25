@extends('layouts.app')
@section('content')
@vite(['resources/css/app.css', 'resources/css/sidebar.css', 'resources/js/sidebar.js'])
<div class="container-fluid">
    @include('includes.sidebar')
    <link rel="icon" type="image/x-icon" href="{{ asset('images/dagat_logo.png') }}">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <h2>OFFICE METRICS CHART</h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="chart-container bg-white p-3 rounded shadow-sm">
                <canvas id="processingTimeBarChart" width="400" height="400"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-container bg-white p-3 rounded shadow-sm">
                <canvas id="processingTimePieChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <h2>DOCUMENTS PROCESSED OVER TIME</h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="chart-container bg-white p-3 rounded shadow-sm">
                <canvas id="documentsProcessedOverTimeChart" width="800" height="400"></canvas>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="table-responsive bg-white p-3 rounded shadow-sm">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Office Name</th>
                            <th>Average Processing Time (Days)</th>
                            <th>Average Processing Time (Hours)</th>
                            <th>Average Processing Time (Minutes)</th>
                            <th>Total Documents Processed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($analytics as $data)
                        <tr>
                            <td>{{ $data->Office_Name }}</td>
                            <td>{{ round($data->avg_processing_time_days, 2) }}</td>
                            <td>{{ round($data->avg_processing_time_hours, 2) }}</td>
                            <td>{{ round($data->avg_processing_time_minutes, 2) }}</td>
                            <td>{{ $data->documents_processed }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const barCtx = document.getElementById('processingTimeBarChart').getContext('2d');
        const pieCtx = document.getElementById('processingTimePieChart').getContext('2d');
        const lineCtx = document.getElementById('documentsProcessedOverTimeChart').getContext('2d');

        const labels = {!! json_encode($analytics->pluck('Office_Name')) !!};
        const daysData = {!! json_encode($analytics->pluck('avg_processing_time_days')) !!};
        const hoursData = {!! json_encode($analytics->pluck('avg_processing_time_hours')) !!};
        const minutesData = {!! json_encode($analytics->pluck('avg_processing_time_minutes')) !!};
        const documentsProcessed = {!! json_encode($analytics->pluck('documents_processed')) !!};

        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Processing Days',
                        data: daysData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Processing Days'
                    }
                }
            }
        });

        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Documents Distribution',
                    data: documentsProcessed,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Documents Processed Distribution'
                    }
                }
            }
        });

        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Documents Processed',
                    data: {!! json_encode($monthlyProcessedDocumentsData) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Documents Processed Over Time'
                    }
                }
            }
        });
    });
</script>
@endsection
