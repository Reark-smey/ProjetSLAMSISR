
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


                <th>Mois</th>
                <th>Nom du Client</th>
                <th>Montant </th>

            </tr>
            </thead>
            @foreach($TopFive as $TopF)

                <tr>

                    <td>{{$TopF->mois}} </td>
                    <td>{{$TopF->NomClient}}</td>
                    <td>{{$TopF->TotalMois}}</td>


                </tr>



            @endforeach
            <br> <br>



        </table>


    </div>


    <div class="d-flex justify-content-center">
        {{ $TopFive->links() }}
    </div>

@stop
