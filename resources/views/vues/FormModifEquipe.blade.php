@extends('layouts.master')
@section('content')
    {!! Form::open(['url' => 'postmodifierEquipe/'.$uneEquipe->Id]) !!}

    <div class="col-md-12 col-sm-12 well well-md">
        <h1>Modification d'une Equipe </h1>
        <div class="form-horizontal">


            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Code Equipe : </label>
                <div class="col-md-2 col-sm-2">
                    <input type="text" name="CodeEq" value="{{$uneEquipe->CodeEq}}" class="form-control" maxlength="3" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 col-sm-3 control-label">Nom Equipe : </label>
                <div class="col-md-2 col-sm-2">
                    <input type="text" name="DesiEq" value="{{$uneEquipe->DesiEq}}" class="form-control" required>
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span>Valider
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary" onclick="javascript:if (confirm('vous êtes sûr ? ')) window.location='{{url('/')}}';">
                        <span class="glyphicon glyphicon-remove"></span>Annuler
                    </button>


                </div>
            </div>

        </div>
    </div>


