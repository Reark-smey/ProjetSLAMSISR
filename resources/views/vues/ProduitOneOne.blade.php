@extends('layouts.master')
@section('content')
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<br><br><br><br><br>
<h1>{{$title}}</h1>

<canvas id="classementChart"></canvas>

<?php
// Transformer les données en JSON pour JavaScript
$labels = [];
$values = [];

foreach ($produit as $item) {
    $labels[] = $item->mois; // Nom de l'application
    $values[] = $item->total_volume; // Total facturé
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


        <th>Nom du Produit</th>
        <th>Mois</th>
        <th>Montant </th>

    </tr>
    </thead>
    @foreach($produit as $Prod)

        <tr>
            <td>{{$Prod->NOM_PRODUIT}}</td>
            <td>{{$Prod->mois}} </td>
            <td>{{$Prod->total_volume}}</td>


        </tr>



    @endforeach
    <br> <br>



</table>
</body>
</html>

@stop

