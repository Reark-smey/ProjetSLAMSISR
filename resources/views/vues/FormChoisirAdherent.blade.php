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
            {!!  Form::open(['route' => 'validerChoixAdherent']) !!}

            <div class="form-group">
                <label class="col-md-3 control-label">Choisir l'adhérent :</label>
                <div class="col-md-6">
                    <input type="hidden" name="hid_id" value="{{$badge->IdBadge}}"/>
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
