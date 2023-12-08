@extends('layouts.app')

@section('content')
@if(session('autorisation'))
<div class="alert alert-danger">
  {{ session('autorisation') }}
</div>
@endif
<small>Bienvenue <h1>{{auth()->user()->name}} {{auth()->user()->prenom}}</h1></small>
@php
    // dd($autorisation);
@endphp
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fas fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Nombre des utilisateurs</span>
          <span class="info-box-number">{{count($users)}} Utilisateurs</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fas fa-plane-departure"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Status du Congé</span>
          <span class="info-box-number">{{$typeStatus}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fas fa-user-tie"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Les employés</span>
          <span class="info-box-number">{{$employes}} Employés</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fas fa-plus"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Journée Ajouté au Congé</span>
          @if($dateDebut)
          <span class="info-box-number">{{$jourAnnuel}} Jours</span>
          @else 
          <span class="info-box-number">+ {{$jourAnnuel}} Jours</span>
          @endif
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-fuchsia"><i class="fas fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Utilisateur Actif</span>
          <span class="info-box-number">{{$user->name}} {{$user->prenom}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-gray"><i class="fas fa-user-tag"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Role</span>
          <span class="info-box-number">{{$user->role}}<small></small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-purple"><i class="fas fa-city"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Ville</span>
          <span class="info-box-number">{{$user->ville}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-olive"><i class="fas fa-envelope"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Email</span>
          <span class="info-box-number">{{$user->email}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-navy"><i class="fas fa-check"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Nombre de congé demandé</span>
          <span class="info-box-number">{{$nbCongeDemandeEmploye}} Jours</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-blue"><i class="fas fa-check-double"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Nombre de congé resté</span>
          <span class="info-box-number">{{$nombreConge}} Jours</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-maroon"><i class="fas fa-file-contract"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Type de contrat</span>
          @if($contrats)
          <span class="info-box-number">{{$contrats}}</span>
          @else 
          <span class="info-box-number">Aucun Type pour le moment</span>
          @endif
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-indigo"><i class="fas fa-portrait"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Specialité</span>
          <span class="info-box-number">{{$specialite}}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
    <!-- /.row -->
    @if(auth()->user()->role === 'admin')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('users.index')}}">
                <div class="info-box">
                  <span class="info-box-icon bg-orange"><i class="fas fa-user"></i></span>  
                  <div class="info-box-content">
                    <span class="info-box-text">La liste des Utilisateurs</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                  </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('employes.index')}}">
          <div class="info-box">
            <span class="info-box-icon bg-pink"><i class="fas fa-user-tie"></i></span>  
            <div class="info-box-content">
              <span class="info-box-text">La liste des Employés</span>
            </div>
            <!-- /.info-box-content -->
          </div>
            </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
    
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
    
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('conges.index')}}">
                <div class="info-box">
                  <span class="info-box-icon bg-teal"><i class="fas fa-plane"></i></span>  
                  <div class="info-box-content">
                    <span class="info-box-text">La liste des Congés</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                  </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <a href="{{route('contrats.index')}}">
                <div class="info-box">
                  <span class="info-box-icon bg-black"><i class="fas fa-file-signature"></i></span>  
                  <div class="info-box-content">
                    <span class="info-box-text">La liste des Contrats</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                  </a>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      @else 
      @endif



@endsection