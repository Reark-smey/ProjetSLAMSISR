@extends('layouts.master')
@section('content')

    <br><br><br><br>
    <br><br><br><br>
    <br><br><br><br>
    <div class="container">
        <div class="blanc">

            <h1> {{$title}}</h1>
        </div>
        <table class="table table-borderer table-striped">
            <thead>
            <tr>

                <th>Date du badge</th>
                <th>Jour</th>
                <th>Lieu</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de récupération</th>

            </tr>
            </thead>
            @foreach($golf as $unBadgeRecuperer)

                <tr>
                    <td>{{$unBadgeRecuperer->DateLiberation}} </td>
                    <td>{{$unBadgeRecuperer->Jour}}</td>
                    <td>{{$unBadgeRecuperer->Lieu}}</td>
                    <td>{{$unBadgeRecuperer->NomRecuperateur}}</td>
                    <td>{{$unBadgeRecuperer->PrenomRecuperateur}}</td>
                    <td>{{$unBadgeRecuperer->DateRecuperer}}</td>

                </tr>



            @endforeach
            <br> <br>



        </table>
        <div class="d-flex justify-content-center">
            {{ $golf->links() }}
        </div>

    </div>

