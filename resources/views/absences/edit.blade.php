@extends('layouts.app')
@section('content')
<div class="card py-2 px-2">
    <div class="float-right" style="margin-left: 900px;">
        <a href="{{route('absences.index')}}" class="btn btn-dark">Revenir</a>
    </div>
<div class="card-title">
<h2>Modification d'absence de {{$absence->employe->nom}} {{$absence->employe->prenom}}</h2>
</div>
<div class="container">
<div class="row">
<div class="col-md-6">
<form action="{{route('absences.update',$absence)}}" method="post">
@csrf
@method("put")
<div class="form-group">
    <label for="motif">Motif</label>
    <input type="text" class="form-control @if($errors->has('motif')) is-invalid @endif "name="motif" value="{{$absence->motif}}"/>
    @if($errors->has('motif'))
    <div class="invalid-feedback">{{$errors->first('motif')}}</div>
    @endif
    </div>
<div class="form-group">
    <label for="dateDebut">Heure Début</label>
    <input type="date" class="form-control @if($errors->has('dateDebut')) is-invalid @endif "name="dateDebut" value="{{$absence->heureDebut}}"/>
    @if($errors->has('dateDebut'))
    <div class="invalid-feedback">{{$errors->first('dateDebut')}}</div>
    @endif
    </div>
<div class="form-group">
    <label for="dateFin">Heure Fin</label>
    <input type="date" class="form-control @if($errors->has('dateFin')) is-invalid @endif " name="dateFin" value="{{$absence->heureFin}}"/>
    @if($errors->has('dateFin'))
    <div class="invalid-feedback">{{$errors->first('dateFin')}}</div>
    @endif
    <button class="btn btn-primary mt-2">Valider L'absecne</button>
</form>
</div>
</div>
</form>
</div>
</div>
@endsection