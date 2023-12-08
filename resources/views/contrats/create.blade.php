@extends('layouts.app')
@section('content')
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Ajouter un contrat</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <form action="{{route('contrats.store')}}"method="post" enctype="multipart/form-data">
              @csrf
                  <div class="form-group @if($errors->has('typeContrat')) is-invalid @endif">
                    <label>Type Contrat</label>
                    <div class="  @if($errors->has('typeContrat')) is-invalid @endif" >
                      <select class="form-control select2
                       @if($errors->has('typeContrat')) is-invalid @endif"
                       name="typeContrat" id="typeContrat">
                        <option value=""
                         class="form-control">
                         Veuillez choisir un type de contrat</option>
                        </div>
                        @foreach($contrats->unique('typeContrat') as $contrat)
                        <option value="{{$contrat->typeContrat}}"
                          @if (old('typeContrat') == $contrat->id) selected="selected" @endif
                          >
                          {{$contrat->typeContrat}}</option>
                              @endforeach
                      </select>  
                       @if($errors->has('typeContrat'))
                    <div class="invalid-feedback">{{$errors->first('typeContrat')}}</div>
                    @endif
                    </div>
                    @if(auth()->user()->role == 'admin')
                    <div class="form-group @if($errors->has('employe_id')) is-invalid @endif">
                        <label>Nom Employe</label>
                        <div class="  @if($errors->has('employe_id')) is-invalid @endif" >
                          <select class="form-control select2
                           @if($errors->has('employe_id')) is-invalid @endif"
                           name="employe_id" id="employe_id">
                            <option value=""
                             class="form-control">
                             Veuillez choisir un employé</option>
                            </div>
                            @if(auth()->user()->role == 'admin')
                            @foreach($employes->unique('nom') as $employe)
                            <option value="{{$employe->id}}"
                              @if (old('employe_id') == $employe->id) selected="selected" @endif
                              >
                              {{$employe->nom}} {{$employe->prenom}}</option>
                                  @endforeach
                                  @else
                                  <option value="{{auth()->user()->id}}">{{auth()->user()->name}} {{auth()->user()->prenom}}</option>
                                  @endif
                          </select>  
                           @if($errors->has('employe_id'))
                        <div class="invalid-feedback">{{$errors->first('employe_id')}}</div>
                        @endif
                        </div>
                        @endif
                        <div class="form-group">
                          <label for="dateContrat">Date Contrat</label>
                          <input type="date" class="form-control @if($errors->has('dateContrat')) is-invalid @endif "name="dateContrat" value="{{old('dateContrat')}}"/>
                          @if($errors->has('dateContrat'))
                          <div class="invalid-feedback">{{$errors->first('dateContrat')}}</div>
                          @endif
                  <button class="btn btn-primary ml-4 mt-5">S'enregistrer</button>
              </form>        
          </div>
        </div>
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
