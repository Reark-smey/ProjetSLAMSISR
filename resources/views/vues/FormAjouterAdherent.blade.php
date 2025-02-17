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
            {!!  Form::open(['route' => 'validerAdherent']) !!}
            <div class="col-md-9 well well-sm">
                <div class="form-group">
                    <label class="col-md-3 control-label">Nom :</label>
                    <div class="col-md-6">
                        <input type="hidden" name="hid_id" value="{{$adherent->IdAdherent}}"/>
                        <input type="text" name="nom" value="{{$adherent->NomAdherent}}" required/>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Prénom :</label>
                    <div class="col-md-6">
                        <input type="text" name="prenom" value="{{$adherent->PrenomAdherent}}" required/>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Email :</label>
                    <div class="col-md-6">
                        <input type="text" name="e_mail" value="{{$adherent->E_mail}}" required/>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Téléphone :</label>
                    <div class="col-md-6">
                        <input type="text" maxlength="10" name="Telephone" value="{{$adherent->Telephone}}" required/>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Licence :</label>
                    <div class="col-md-6">
                        <input type="text" name="licence" value="{{$adherent->License}}" />
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Niveau :</label>
                    <div class="col-md-6">
                        <input type="number" min="0" max="54" name="niveau" value="{{$adherent->Niveau}}" />
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Identifiant :</label>
                    <div class="col-md-6">
                        <input type="text" name="username" value="{{$adherent->Adherent_username}}" required />
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label"  >Mot de passe :</label>
                    <div class="col-md-6">
                        <input type="password" maxlength="10" name="password" value="{{$adherent->mdp_adherent}}" required />
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label class="col-md-3 control-label">Catégorie :</label>
                    <div class="col-md-6">
                        <input type="text" name="type" value="{{$adherent->type}}" required/>
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
