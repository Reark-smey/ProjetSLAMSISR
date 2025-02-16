@extends('layouts.master')
@section('content')


    <div class="container">
        <div class="blanc">
            <h1>Liste de mes Equipes</h1>
        </div>
        <table class="table table-borderer table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>CodeEq</th>
                <th>DesiEq</th>

            </tr>
            </thead>
            @foreach($mesEquipes as $unEq)
                <tr>
                    <td>{{$unEq->Id}}</td>
                    <td>{{$unEq->CodeEq}}</td>
                    <td>{{$unEq->DesiEq}}</td>


                    <td style="text-align:center;">
                        <a href="{{url('/modifierEquipe')}}/{{$unEq->Id}}">
                            <span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier">

                            </span>
                        </a>
                    </td>
                </tr>
            @endforeach
            <br> <br>



        </table>
    </div>
