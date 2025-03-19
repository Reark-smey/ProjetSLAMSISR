@extends('layouts.master')
@section('content')
    <br><br><br><br>

<div>
    <div class="container">
        <div class="blanc">
            <h1> {{ $title }}</h1>

        </div>
        {!!  Form::open(['route' => 'validerChoixGrandClient']) !!}

        <div class="form-group">
            <label class="col-md-3 control-label">Grand Client:</label>
            <div class="col-md-6">
                <select class="form-control" name="GrandClient">
                    <option value="0" disabled selected="selected"> Sélectionner un Grand Client</option>
                    @foreach($client as $unC)
                    <option value="{{$unC->GrandClientID}}" > {{$unC->NomGrandClient}} </option>

                    @endforeach
                </select>

            </div>
        </div>
        <br><br>


        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-default btn-primary"><span
                        class="glyphicon glyphicon-ok"></span> Valider
                </button>
                &nbsp;
                <button type="button" class="btn btn-default btn-primary"
                        onclick="{ window.location = '{{ url('/') }}';}">
                    <span class="glyphicon glyphicon-remove"></span>Annuler
                </button>
            </div>
        </div>
    </div>

    {{ $erreur }}

</div>


@stop
