@extends('layouts.master')
@section('content')

    <br><br><br><br>
    <div class="container">
        <div class="blanc">
            <h1>Liste des personnes autorisées à jouer au Gouverneur</h1>
        </div>
        <table class="table table-borderer table-striped">
            <thead>
            <tr>
                <th>Nom Prénom</th>


            </tr>
            </thead>
            @foreach($lesAdherents as $unAdh)
                <tr>
                    <td>{{$unAdh->NomAdherent}} {{$unAdh->PrenomAdherent}}</td>
                    <td style="text-align:center;">
                        <a href="{{url('/ProfilAdherent')}}/{{$unAdh->IdAdherent}}">
                            <span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Voir Profil">

                            </span>
                        </a>
                    </td>
                </tr>



            @endforeach
            <br> <br>



        </table>
    </div>
