@extends('layouts.app')

@section('content')
<div class="form-group text-right ml-5">
  <a href="{{route('users.index')}}" style="width:40px;height:30px;" class="bnt btn-dark px-2 py-2">
  Revenir
    <i class="fas fa-undo ml-2"></i>
  </a>
</div>
<div class="card py-2 px-2">
<div class="card-title">
<h2>Modifier </h2>
</div>
<div class="container">
<div class="row">
<div class="col-md-6">
<form action="{{route('users.update',['id'=> $user->id])}}" method="post" enctype="multipart/form-data">
@csrf
@method("put")
<div class="form-group">
    <label for="nom">Nom</label>
    <input type="text" class="form-control @if($errors->has('nom')) is-invalid @endif "name="nom" value="{{$user->name}}"/>
    @if($errors->has('nom'))
    <div class="invalid-feedback">{{$errors->first('nom')}}</div>
    @endif
    <label for="prenom">Prenom</label>
    <input type="text" class="form-control @if($errors->has('prenom')) is-invalid @endif "name="prenom" value="{{$user->prenom}}"/>
    @if($errors->has('prenom'))
    <div class="invalid-feedback">{{$errors->first('prenom')}}</div>
    @endif
    <label for="email">Email</label>
    <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif "name="email" value="{{$user->email}}"/>
    @if($errors->has('email'))
    <div class="invalid-feedback">{{$errors->first('email')}}</div>
    @endif
    </div>
    <div class="input-group mb-3 mt-4">
        <div class="input-group-prepend">
          <span class="input-group-text">Choisir un fichier</span>
        </div>
        <div class="custom-file py-2">
        <label for="Fichier" class="custom-file-label"></label>
          <input type="file" class="custom-file-input @if($errors->has('photo')) is-invalid @endif" name="photo" value="{{old('photo')}}"/>
          @if($errors->has('photo'))
          <div class="invalid-feedback">{{$errors->first('photo')}}</div>
          @endif
        </div>

</div>
</div>
<div class="col-md-6">
<div class="form-group">
    <label for="ville">Ville</label>
    <input type="text" class="form-control @if($errors->has('ville')) is-invalid @endif " name="ville" value="{{$user->ville}}"/>
    @if($errors->has('ville'))
    <div class="invalid-feedback">{{$errors->first('ville')}}</div>
    @endif
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif " name="password"/>
    @if($errors->has('password'))
    <div class="invalid-feedback">{{$errors->first('password')}}</div>
    @endif
    </div>
    <div class="form-group">
    <label for="confirmPassword">Confirmation de mot de passe</label>
    <input type="password" class="form-control @if($errors->has('password_confirmation')) is-invalid @endif " name="password_confirmation" value="{{$user->confirmPassword}}"/>
    @if($errors->has('password_confirmation'))
    <div class="invalid-feedback">{{$errors->first('password_confirmation')}}</div>
    @endif
    <button class="btn btn-primary mt-2">S'enregistrer</button>
</form>
</div>
</div>
@endsection