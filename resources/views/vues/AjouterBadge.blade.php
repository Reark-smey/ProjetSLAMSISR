@extends('layouts.master')
@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <div>
        <div class="container">
            <div class="blanc">
                <h1>{{$title}}</h1>
            </div>

            {{-- Le formulaire se soumet automatiquement au changement d'adhérent --}}
            {!! Form::open(['route' => 'validerAjoutBadge', 'method' => 'post']) !!}

            {{-- Liste déroulante des adhérents --}}
            <div class="form-group">
                <label class="col-md-3 control-label">Choisir l'adhérent :</label>
                <div class="col-md-6">
                    <select class="form-control" name="adherent" onchange="this.form.submit()">
                        <option value="0" disabled selected="selected">Sélectionner un adhérent</option>
                        @foreach($adherent as $unAdh)
                            <option value="{{ $unAdh->IdAdherent }}"
                                    @if(isset($idAdherent) && $unAdh->IdAdherent == $idAdherent)
                                        selected="selected"
                                @endif>
                                {{ $unAdh->NomAdherent }} {{ $unAdh->PrenomAdherent }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <br><br>

            {{-- Liste déroulante des jours de la semaine --}}
            <div class="form-group">
                <label class="col-md-3 control-label">Jour de la semaine :</label>
                <div class="col-md-6">
                    <select class="form-control" name="Jour">
                        <option value="0" disabled selected="selected">Sélectionner un jour</option>
                        @foreach($joursSemaine as $val => $jour)
                            <option value="{{ $val }}">{{ $jour }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <br>

            {{-- Liste déroulante des lieux autorisés --}}
            <div class="form-group">
                <label class="col-md-3 control-label">Choix autorisés :</label>
                <div class="col-md-6">
                    <select class="form-control" name="Lieu">
                        <option value="0" disabled selected="selected">Sélectionner un golf</option>
                        @foreach($options as $id => $nom)
                            <option value="{{ $id }}">{{ $nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <br>

            {{-- Boutons --}}
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button type="submit" class="btn btn-default btn-primary">
                        <span class="glyphicon glyphicon-ok"></span> Valider
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-default btn-primary"
                            onclick="window.location='{{ url('/') }}';">
                        <span class="glyphicon glyphicon-remove"></span> Annuler
                    </button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop
