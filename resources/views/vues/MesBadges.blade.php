@extends('layouts.master')
@section('content')

    <br><br><br><br>
    <br><br><br><br>
    <br><br>

    <div class="container">
        <div class="blanc">
            <h1>Mes Badges</h1>
        </div>
        <table class="table table-borderer table-striped">
            <thead>
            <tr>


                <th>Lieux</th>
                <th>Jour</th>


            </tr>
            </thead>
            @foreach($mesBadges as $mesB)
                <tr>


                    <td>{{ $mesB->Lieu }}</td>
                    <td>{{ $mesB->Jour }}</td>






                </tr>
            @endforeach
            <br> <br>



        </table>

    </div>




