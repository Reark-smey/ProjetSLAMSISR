@extends('layouts.master')
@section('content')
    <br><br><br><br>

    <div class="container">
        <div class="blanc">
            <h1>{{$title}}</h1>
        </div>

        @php
            $clientVariables = [];

            foreach ($TopFive as $record) {
                $clientVariables[$record->NomClient][] = [
                    'mois' => $record->mois,
                    'montant' => $record->TotalMois
                ];
            }
        @endphp

        <canvas id="clientsChart"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var ctx = document.getElementById('clientsChart').getContext('2d');
                var chartData = {
                    labels: [],
                    datasets: []
                };

                @php
                    $colors = ['red', 'blue', 'green', 'orange', 'purple'];
                    $index = 0;
                @endphp

                @foreach($clientVariables as $client => $records)
                let data_{{ str_replace(' ', '_', $client) }} = {
                    label: "{{ $client }}",
                    borderColor: "{{ $colors[$index % count($colors)] }}",
                    fill: false,
                    data: []
                };

                @foreach($records as $record)
                if (!chartData.labels.includes("{{ $record['mois'] }}")) {
                    chartData.labels.push("{{ $record['mois'] }}");
                }
                data_{{ str_replace(' ', '_', $client) }}.data.push({
                    x: "{{ $record['mois'] }}",
                    y: {{ $record['montant'] }}
                });
                @endforeach

                chartData.datasets.push(data_{{ str_replace(' ', '_', $client) }});
                @php $index++; @endphp
                @endforeach

                new Chart(ctx, {
                    type: 'line',
                    data: chartData,
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                title: { display: true, text: 'Mois' },
                                ticks: {
                                    maxRotation: 45,
                                    minRotation: 45
                                }
                            },
                            y: { title: { display: true, text: 'Montant' } }
                        }
                    }
                });
            });
        </script>

        @foreach($clientVariables as $client => $records)
            <div class="client-section">
                <h2>{{ $client }}</h2>
                <table class="table table-bordered table-striped mt-3">
                    <thead>
                    <tr>
                        <th>Mois</th>
                        <th>Montant</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $record['mois'] }}</td>
                            <td>{{ $record['montant'] }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
        @endforeach
    </div>
@stop
