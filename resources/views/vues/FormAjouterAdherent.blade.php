@extends('layouts.master')
@section('content')
    <div>
        <div class="container">
            <div class="blanc">
                <h1> {{ $title }}</h1>

            </div>
            {!!  Form::open(['route' => 'postManga']) !!}
            <div class="col-md-9 well well-sm">
                <div class="form-group">
                    <label class="col-md-3 control-label">Titre :</label>
                    <div class="col-md-6">
                        <input type="hidden" name="hid_id" value="{{$manga->IdAdherent}}"/>
                        <input type="text" name="nom" value="{{$manga->NomAdherent}}" required/>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Titre :</label>
                    <div class="col-md-6">
                        <input type="text" name="prenom" value="{{$manga->PrenomAdherent}}" required/>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Titre :</label>
                    <div class="col-md-6">
                        <input type="text" name="e_mail" value="{{$manga->E_mail}}"/>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Titre :</label>
                    <div class="col-md-6">
                        <input type="text" name="licence" value="{{$manga->License}}" required/>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Titre :</label>
                    <div class="col-md-6">
                        <input type="number" min="0" max="54" name="niveau" value="{{$manga->Niveau}}" />
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Titre :</label>
                    <div class="col-md-6">
                        <input type="text" name="username" value="{{$manga->Adherent_username}}" required />
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Titre :</label>
                    <div class="col-md-6">
                        <input type="password" maxlength="10" name="password" value="{{$manga->mdp_adherent}}" required />
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Titre :</label>
                    <div class="col-md-6">
                        <input type="text" name="type" value="{{$manga->type}}"/>
                    </div>
                </div>
                <br>


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
    </div>
@stop
