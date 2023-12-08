@extends('layouts.app')
@section('content')
<div class="d-flex">
    <h2>Modification de {{$employe->nom}} {{$employe->prenom }}</h2>
    <a href="{{route('employes.index')}}"class="btn btn-secondary"style="margin-left:700px;height:40px;margin-top:10px;">Revenir</a>
</div>
<div class="card py-2 px-2">
<div class="card-title">
</div>
<div class="container">
<div class="row">
<div class="col-md-6">
<form action="{{route('employes.update',['id'=> $employe->id])}}" method="post" enctype="multipart/form-data">
@csrf
@method("put")
<div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control @if($errors->has('nom')) is-invalid @endif "name="nom" value="{{$employe->nom}}"/>
    @if($errors->has('nom'))
    <div class="invalid-feedback">{{$errors->first('nom')}}</div>
    @endif
    <label for="prenom">Prenom</label>
    <input type="text" class="form-control @if($errors->has('prenom')) is-invalid @endif "name="prenom" value="{{$employe->prenom}}"/>
    @if($errors->has('prenom'))
    <div class="invalid-feedback">{{$errors->first('prenom')}}</div>
    @endif
    <label for="ville">Ville</label>
    <input type="ville" class="form-control @if($errors->has('ville')) is-invalid @endif "name="ville" value="{{$employe->ville}}"/>
    @if($errors->has('ville'))
    <div class="invalid-feedback">{{$errors->first('ville')}}</div>
    @endif
    </div>
    <div class="input-group mb-3 mt-4">
        <div class="input-group-prepend">
          <span class="input-group-text">Choisir un fichier</span>
        </div>
        <div class="custom-file py-2">
        <label for="Fichier" class="custom-file-label"></label>
          <input type="file" class="custom-file-input @if($errors->has('photo')) is-invalid @endif" name="photo" value="{{old($employe->photo)}}"/>
          @if($errors->has('photo'))
          <div class="invalid-feedback">{{$errors->first('photo')}}</div>
          @endif
        </div>
</div>
<div class="form-group">
    <label for="adresse">Adresse</label>
    <input type="text" class="form-control @if($errors->has('adresse')) is-invalid @endif " name="adresse" value="{{$employe->adresse}}"/>
    @if($errors->has('adresse'))
    <div class="invalid-feedback">{{$errors->first('adresse')}}</div>
    @endif
</div>
</div>
<div class="col-md-6">
<div class="form-group">
    <label for="numeroTelephone">Numero de telephone</label>
    <input type="text" class="form-control @if($errors->has('numeroTelephone')) is-invalid @endif " name="numeroTelephone" value="{{$employe->numeroTelephone}}"/>
    @if($errors->has('numeroTelephone'))
    <div class="invalid-feedback">{{$errors->first('numeroTelephone')}}</div>
    @endif
    </div>
    <div class="form-group">
    <label for="dateDebut">Date de début</label>
    <input type="date" class="form-control @if($errors->has('dateDebut')) is-invalid @endif " name="dateDebut" value="{{$employe->dateDebut}}"/>
    @if($errors->has('dateDebut'))
    <div class="invalid-feedback">{{$errors->first('dateDebut')}}</div>
    @endif
    <div class="form-group">
        <label for="dateFin">Date de fin</label>
        <input type="date" class="form-control @if($errors->has('dateFin')) is-invalid @endif " name="dateFin" value="{{$employe->dateFin}}"/>
        @if($errors->has('dateFin'))
        <div class="invalid-feedback">{{$errors->first('dateFin')}}</div>
        @endif
        <div class="form-group">
            <label for="specialite">Specialite</label>
            <input type="text" class="form-control @if($errors->has('specialite')) is-invalid @endif " name="specialite" value="{{$employe->specialite}}"/>
            @if($errors->has('specialite'))
            <div class="invalid-feedback">{{$errors->first('specialite')}}</div>
            @endif
            <div class="form-group">
              <label for="Mot de passe">Mot de passe</label>
              <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif " name="password"/>
           <button class="btn btn-primary mt-2">S'enregistrer</button>
</form>
</div>
</div>
@endsection