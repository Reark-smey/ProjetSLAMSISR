@extends("layouts.master")
@section('content')
{!! Form::open(['url' => 'postEquipe']) !!}

<div class="col-md-12 col-sm-12 well well-md">
    <h1></h1>
<div class="form-horizontal">

<div class="form-group">
    <label class="col-md-3 col-sm-3 control-label">Code :</label>
    <div class="col-md-2 col-sm-2">
        <input type="text" name="CodeEq" value="" class="form-control" max="3" required>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 col-sm-3 control-label">Designation :</label>
    <div class="col-md-2 col-sm-2">
        <input type="text" name="DesiEq" value="" class="form-control" required>
    </div>
</div>


<div class="form-group">
    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
        <button type="submit" class="btn btn-default btn-primary">
            <span class="glyphicon glyphicon-ok"></span>Valider
        </button>
        &nbsp;
        <button type="button" class="btn btn-default btn-primary"
                onclick="javascript:if(confirm('vous êtes sûr ?'))
            window.location='{{url('/')}}';">
            <span class="glyphicon glyphicon-remove"></span>Annuler
        </button>
    </div>
</div>

</div>
    </div>


@stop
