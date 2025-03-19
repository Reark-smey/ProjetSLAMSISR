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


    </div>

@stop
