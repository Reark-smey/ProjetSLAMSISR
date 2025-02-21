@extends('layouts.master')
@section('content')
    <br>
    <br>
    <br>
    <br>
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
                <label>Choisir le lieu :</label>
                <select class="form-control" name="Lieu">
                    <option value="" disabled selected="selected">Sélectionner un lieu</option>
                    @foreach($Lieu as $unLieu)
                        <option value="{{ $unLieu->NomGolf }}">{{ $unLieu->NomGolf }}</option>
                    @endforeach
                </select>
            </div>
    <br>
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

            <button type="submit" class="btn btn-primary">Valider</button>
            {!! Form::close() !!}


        </div>
    </div>
