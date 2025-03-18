@extends('layouts.master')
@section('content')
    <br><br><br><br>
    <br><br><br><br><br><br><br><br>

    <div class="container">
        <div class="blanc">
            <h1>Les Informations</h1>
        </div>
        <table class="table table-borderer table-striped">
            <thead>
            <tr>

                <th>Nom</th>
                <th>Prénom</th>
                <th>Lieux des badges</th>
                <th>Jour</th>
                <th>Nombre de bages</th>
                <th>Nombres de badges libérés</th>
                <th>Nombre de bages libres récupérés</th>
                <th>Prix Total</th>
                <th>Téléphone</th>
                <th>Email</th>

            </tr>
            </thead>
            @foreach($lesAdherents as $unAdh)
                <tr>

                    <td>{{$unAdh->NomAdherent}}</td>
                    <td>{{$unAdh->PrenomAdherent}}</td>
                    <td>{!! $unAdh->Lieu !!}</td>
                    <td>{!! $unAdh->Jour !!}</td>
                    <td>{{$unAdh->NbBadges}}</td>
                    <td>{{$unAdh->CompteurLiberationBadge}}</td>
                    <td>{{$unAdh->CompteurRecuperationBadge}}</td>
                    <td>{{$unAdh->PrixTotal}}</td>
                    <td>{{$unAdh->Telephone}}</td>
                    <td>{{$unAdh->E_mail}}</td>


                    <td style="text-align:center;">
                        <a href="{{url('/modifierAdherent')}}/{{$unAdh->IdAdherent}}">
                            <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier">

                            </span>
                        </a>
                    </td>


                </tr>
            @endforeach
            <br> <br>



        </table>

    </div>




