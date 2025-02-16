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

                <th>Date</th>
                <th>Jour</th>
                <th>Lieu</th>
                <th>Réserver</th>

            </tr>
            </thead>
            @foreach($golf as $unBadgeLibre)

                <tr>
                    <td>{{$unBadgeLibre->DateLiberation}} </td>
                    <td>{{$unBadgeLibre->Jour}}</td>
                    <td>{{$unBadgeLibre->Lieu}}</td>
                    <td style="text-align:center;">
                        <a href="{{url('/ReserverBadgeLibre')}}/{{$unBadgeLibre->IdBadgeLibre}}">
                            <span class="glyphicon glyphicon-book" data-toggle="tooltip" data-placement="top" title="Réserver">

                            </span>
                        </a>
                    </td>
                </tr>



            @endforeach
            <br> <br>



        </table>
        <div class="d-flex justify-content-center">
            {{ $golf->links() }}
        </div>

    </div>

