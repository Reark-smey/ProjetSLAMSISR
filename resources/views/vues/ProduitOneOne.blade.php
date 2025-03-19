
@extends('layouts.master')
@section('content')
    <br><br><br><br>

    <div class="container">
        <div class="blanc">

            <h1> {{$title}}</h1>
        </div>
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


    </div>

@stop
