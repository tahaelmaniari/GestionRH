@extends('layouts.app')
@section('content')
    <div class="card card-default">
      <div class="card-header">
        <div class="text-right">
          <a href="{{route('conges.index')}}" class="btn btn-dark">Revenir</a>
        </div>
        <h3 class="card-title">Demander un congé</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <form action="{{route('conges.store')}}"method="post" enctype="multipart/form-data">
              @csrf 
              @if(auth()->user()->role == 'admin')
              <div class="form-group @if($errors->has('employe_id')) is-invalid @endif">
                <label>Nom Employé</label>
                <div class="  @if($errors->has('employe_id')) is-invalid @endif" >
                  <select class="form-control select2
                   @if($errors->has('employe_id')) is-invalid @endif"
                   name="employe_id" id="employe_id">
                    <option value=""
                     class="form-control">
                     Veuillez choisir un employé</option>
                    </div>
                    @foreach($employes as $employe)
                    <option value="{{$employe->id}}"
                      @if (old('employe_id') == $employe->id) selected="selected" @endif
                      >
                      {{$employe->nom}} {{$employe->prenom}}</option>
                          @endforeach
                  </select>  
                  @endif
                  @if($errors->has('employe_id'))
                <div class="invalid-feedback">{{$errors->first('employe_id')}}</div>
                @endif
                </div>
              </div>
              <div class="form-group @if($errors->has('typeConge_id')) is-invalid @endif">
                <label>Type congé</label>
                <div class="  @if($errors->has('typeConge_id')) is-invalid @endif" >
                  <select class="form-control select2
                   @if($errors->has('typeConge_id')) is-invalid @endif"
                   name="typeConge_id" id="typeConge_id">
                    <option value=""
                     class="form-control">
                     Veuillez choisir un type de congé</option>
                    </div>
                    @foreach($typeConges->unique('nom') as $typeConge)
                    <option value="{{$typeConge->id}}"
                      @if (old('typeConge_id') == $typeConge->id) selected="selected" @endif
                      >
                      {{$typeConge->nom}}</option>
                          @endforeach
                  </select>  
                   @if($errors->has('typeConge_id'))
                <div class="invalid-feedback">{{$errors->first('typeConge_id')}}</div>
                @endif
                </div>
                  <div class="form-group">
                  <label for="dateDebut">Date de Debut</label>
                  <input type="date" class="form-control @if($errors->has('dateDebut')) is-invalid @endif " name="dateDebut" value="{{old('dateDebut')}}"/>
                  @if($errors->has('dateDebut'))
                  <div class="invalid-feedback">{{$errors->first('dateDebut')}}</div>
                  @endif
                  </div>
                  <div class="form-group">
                    <label for="dateFin">Date de fin</label>
                    <input type="date" class="form-control @if($errors->has('dateFin')) is-invalid @endif " name="dateFin" value="{{old('dateFin')}}"/>
                    @if($errors->has('dateFin'))
                    <div class="invalid-feedback">{{$errors->first('dateFin')}}</div>
                    @endif
                    </div>
                    <div class="form-group">
                      <label for="nombreCongeDemandeEmploye">Nombre de congé demandé</label>
                      <input type="number" step= "0.5" class="form-control @if($errors->has('nombreCongeDemandeEmploye')) is-invalid @endif " name="nombreCongeDemandeEmploye" value="{{old('nombreCongeDemandeEmploye')}}"/>
                      @if($errors->has('nombreCongeDemandeEmploye'))
                      <div class="invalid-feedback">{{$errors->first('nombreCongeDemandeEmploye')}}</div>
                      @endif
                      </div>
                    <button class="btn btn-primary">Enregistrer</button>
              </div>
              </form>
          </div>
        </div>
 
@endsection
@section('js')
<script>//Initialize Select2 Elements
    $('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
</script>
@endsection