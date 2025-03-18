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
            {!! Form::open(['route' => 'validerAjoutBadge']) !!}
            <input type="hidden" name="idBadge" value="{{ $idBadge }}"/>

            <div class="form-group">
                <label class="col-md-3 control-label">Choisir l'adhérent :</label>
                <div class="col-md-6">
                    <select class="form-control" name="adherent">
                        <option value="0" disabled selected="selected">Sélectionner un adhérent</option>
                        @foreach($adherent as $unAdh)
                            <option value="{{ $unAdh->IdAdherent }}" @if($unAdh->IdAdherent == old('adherent')) selected="selected" @endif>
                                {{ $unAdh->NomAdherent }} {{ $unAdh->PrenomAdherent }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br><br>


            <div class="form-group">
                <label class="col-md-3 control-label">Choisir le Lieu:</label>
                <div class="col-md-6">
                    <select class="form-control" name="Lieu">
                        <option value="" disabled selected="selected">Sélectionner un lieu</option>
                        @foreach($Lieu as $unLieu)
                            <option value="{{ $unLieu->NomGolf }}">{{ $unLieu->NomGolf }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br><br>

            <div class="form-group">
                <label class="col-md-3 control-label">Jour de la semaine :</label>
                <div class="col-md-6">
                    <select class="form-control" name="Jour">
                        <option value="0" disabled selected="selected">Sélectionner un jour</option>
                        <option value="Dimanche">Dimanche</option>
                        <option value="Lundi">Lundi</option>
                        <option value="Mardi">Mardi</option>
                        <option value="Mercredi">Mercredi</option>
                        <option value="Jeudi">Jeudi</option>
                        <option value="Vendredi">Vendredi</option>
                        <option value="Samedi">Samedi</option>
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
    </div>
