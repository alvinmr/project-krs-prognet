@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Info Indeks Prestasi</h4>
        </div>
        <div class="card-body">
            <canvas id="chartPrestasi" height="100"></canvas>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const ctx = document.getElementById('chartPrestasi').getContext('2d');
        const DATA_COUNT = 7;
        const NUMBER_CFG = {
            count: DATA_COUNT,
            min: -100,
            max: 100
        };

        const labels = ['{!! implode("', '", $listTahunAjaran) !!}'];

        const data = {
            labels: labels,
            datasets: [{
                    label: 'IPK',
                    data: ['{!! implode(
    "', '",
    auth('mahasiswa')->user()->getListIpk(),
) !!}'],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                },
                {
                    label: 'IPS',
                    data: ['{!! implode(
    "', '",
    auth('mahasiswa')->user()->getListIps(),
) !!}'],
                    fill: false,
                    borderColor: 'rgb(255, 0, 255)',
                    tension: 0.1
                }
            ]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Trend Mahasiswa'
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                    },
                }
            },
        };
        const myChart = new Chart(ctx, config);
    </script>
@endpush
