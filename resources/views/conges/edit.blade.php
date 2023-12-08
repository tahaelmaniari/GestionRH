@extends('layouts.app')
@section('content')
<div class="card py-2 px-2">
    <div class="float-right" style="margin-left: 900px;">
        <a href="{{route('conges.index')}}" class="btn btn-dark">Revenir</a>
    </div>
<div class="card-title">
<h2>Modification du congé de {{$conge->employe->nom}} {{$conge->employe->prenom}}</h2>
</div>
<div class="container">
<div class="row">
<div class="col-md-6">
<form action="{{route('conges.update',['id'=> $conge->id])}}" method="post" enctype="multipart/form-data">
@csrf
@method("put")
<div class="form-group @if($errors->has('typeConge_id')) is-invalid @endif">
    <label>Type congé</label>
    <div class="  @if($errors->has('typeConge_id')) is-invalid @endif" >
      <select class="form-control select2
       @if($errors->has('typeConge_id')) is-invalid @endif"
       name="typeConge_id" id="typeConge_id">
       @foreach($typeConges->unique('nom') as $c)
        <option value="{{$conge->typeConge->id}}"
            @if (old('typeConge_id') == $typeConge->id) selected="selected" @endif
            >
          {{$c->nom}}</option>
      @endforeach
        </select>  
       @if($errors->has('typeConge_id'))
    <div class="invalid-feedback">{{$errors->first('typeConge_id')}}</div>
    @endif
    </div>
<div class="form-group">
    <label for="dateDebut">Date de Debut</label>
    <input type="date" class="form-control @if($errors->has('dateDebut')) is-invalid @endif "name="dateDebut" value="{{$conge->dateDebut}}"/>
    @if($errors->has('dateDebut'))
    <div class="invalid-feedback">{{$errors->first('dateDebut')}}</div>
    @endif
    </div>
</div>
<div class="form-group">
    <label for="dateFin">Date de fin</label>
    <input type="date" class="form-control @if($errors->has('dateFin')) is-invalid @endif " name="dateFin" value="{{$conge->dateFin}}"/>
    @if($errors->has('dateFin'))
    <div class="invalid-feedback">{{$errors->first('dateFin')}}</div>
    @endif
    <div class="form-group">
        <label for="nombreCongeDemandeEmploye">Nombre de congé demandé au employé</label>
        <input type="number" step= "0.5" class="form-control @if($errors->has('nombreCongeDemandeEmploye')) is-invalid @endif "name="nombreCongeDemandeEmploye" value="{{$conge->nombreCongeDemandeEmploye}}"/>
        @if($errors->has('nombreCongeDemandeEmploye'))
        <div class="invalid-feedback">{{$errors->first('nombreCongeDemandeEmploye')}}</div>
        @endif
        </div>
    <button class="btn btn-primary mt-2">S'enregistrer</button>
</form>
</div>
</form>
</div>
</div>
@endsection
@section('js')
<script>
$('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
</script>
    @endsection