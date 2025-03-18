@extends('layouts.master')
@section('content')


    <br><br><br><br>
    <br><br><br><br>
    <br><br><br><br>

    <div>
        <div class="container">
            <div class="blanc">
                <h1> {{ $title }}</h1>

            </div>
            {!!  Form::open(['route' => 'postGolf']) !!}

            <div class="form-group">
                <label class="col-md-3 control-label">Golf:</label>
                <div class="col-md-6">
                    <select class="form-control" name="sel_golf">
                        <option value="0" disabled selected="selected"> Sélectionner un golf</option>
                        @foreach($golf as $unG)
                            <option value="{{$unG->IdGolf}}" > {{$unG->NomGolf}} </option>

                        @endforeach
                    </select>

                </div>
            </div>


            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button type="submit" class="btn btn-default btn-primary"><span
                            class="glyphicon glyphicon-ok"></span> Valider
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary"
                            onclick="{ window.location = '{{ url('/ListeBadgesLibres') }}';}">
                        <span class="glyphicon glyphicon-remove"></span>Annuler
                    </button>
                </div>
            </div>
        </div>

        {{ $erreur }}

    </div>


@stop
