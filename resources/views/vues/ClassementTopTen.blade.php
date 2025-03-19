@extends('layouts.master')
@section('content')
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<br><br><br><br><br>
<h1>{{ $title }}</h1>

<canvas id="classementChart"></canvas>

<?php
// Transformer les données en JSON pour JavaScript
$labels = [];
$values = [];

foreach ($classement as $item) {
    $labels[] = $item->NomAppli; // Nom de l'application
    $values[] = $item->total_prix; // Total facturé
}

$labelsJson = json_encode($labels);
$valuesJson = json_encode($values);
?>

<script>
    const labels = {!! $labelsJson !!}; // Injection des labels en JS
    const data = {!! $valuesJson !!}; // Injection des valeurs en JS

    const ctx = document.getElementById('classementChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total facturé (€)',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>

<table class="table table-borderer table-striped">
    <thead>
    <tr>


        <th>Nom de l'application</th>
        <th>Nom du Grand Client</th>
        <th>Recette </th>

    </tr>
    </thead>
    @foreach($classement as $Unclient)

        <tr>

            <td>{{$Unclient->NomAppli}} </td>
            <td>{{$Unclient->NomGrandClient}}</td>
            <td>{{$Unclient->total_prix}}</td>


        </tr>



    @endforeach
    <br> <br>



</table>
</body>
</html>

@stop

