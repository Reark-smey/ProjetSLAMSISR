@extends('layouts.master')
@section('content')


    <div class="container">
        <div class="blanc">
            <h1>Liste de mes Employes</h1>
        </div>
        <table class="table table-borderer table-striped">
            <thead>
            <tr>
                <th>Civilité</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Mot de passe</th>
                <th>Intérêt</th>
                <th>Profil</th>
                <th>Message</th>
                <th>Numérode l'équipe</th>
            </tr>
            </thead>
            @foreach($mesEmployes as $unEmp)
                <tr>
                    <td>{{$unEmp->civilite}}</td>
                    <td>{{$unEmp->nom}}</td>
                    <td>{{$unEmp->prenom}}</td>
                    <td>{{$unEmp->pwd}}</td>
                    <td>{{$unEmp->interet}}</td>
                    <td>{{$unEmp->profil}}</td>
                    <td>{{$unEmp->message}}</td>
                    <td>{{$unEmp->Id}}</td>

                    <td style="text-align:center;">
                        <a href="{{url('/modifierEmploye')}}/{{$unEmp->numEmp}}">
                            <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier">

                            </span>
                        </a>
                    </td>
                </tr>
            @endforeach
            <br> <br>



        </table>
    </div>
