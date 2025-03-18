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
            {!! Form::open(['route' => 'validerBadgeLibre']) !!}
            <div class="col-md-9 well well-sm">

                <div class="form-group">
                    <label class="col-md-3 control-label">Votre Choix :</label>
                    <div class="col-md-6">
                        <input type="hidden" name="hid_id" value="{{$badge->IdBadgeLibre}}"/>
                        <input type="hidden" name="hid_idadherent" value="{{session()->get('id_adherent')}}"/>
                        <input type="text" class="form-control" name="Badge" value="{{ $badge->IdBadgeLibre }}" readonly />
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Lieu :</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="Lieu" value="{{ $info ? $info->Lieu : '' }}" readonly />
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Jour de la semaine :</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="Jour" value="{{ $info ? $info->Jour : '' }}" readonly />
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Date :</label>
                    <div class="col-md-6">
                        <input type="date" class="form-control" name="Date" value="{{ $badge->DateLiberation }}" readonly />
                    </div>
                </div>
                <br><br>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-default btn-primary">
                            <span class="glyphicon glyphicon-ok"></span> Valider
                        </button>
                        &nbsp;
                        <button type="button" class="btn btn-default btn-primary" onclick="{ window.location = '{{ url('/') }}';}">
                            <span class="glyphicon glyphicon-remove"></span> Annuler
                        </button>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
