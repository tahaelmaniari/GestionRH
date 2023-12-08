@extends('layouts.app')
@section('content')
<div class="text-right">
  <a href="{{route('soldes.index')}}" class="btn btn-dark">Revenir
    <i class="fas fa-undo ml-2"></i>
  </a>
</div>
    <div class="card card-default mt-4">
      <div class="card-header">
        <h3 class="card-title">Ajouter un solde</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <form action="{{route('soldes.store')}}"method="post" enctype="multipart/form-data">
              @csrf 
              <div class="form-group @if($errors->has('conge_id')) is-invalid @endif">
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
                      @if (old('employe_id') == $employe->id) selected="" @endif
                      >
                      {{$employe->nom}} {{$employe->prenom}}</option>
                          @endforeach
                  </select>  
                  @if($errors->has('employe_id'))
                <div class="invalid-feedback">{{$errors->first('employe_id')}}</div>
                @endif
                </div>
              </div>
                    <div class="form-group">
                      <label for="jourAnnuel">Jour Annuel
                      </label>
                      <input type="number" step ="0.5"class="form-control @if($errors->has('jourAnnuel')) is-invalid @endif " name="jourAnnuel" value="{{old('jourAnnuel')}}"/>
                      @if($errors->has('jourAnnuel'))
                      <div class="invalid-feedback">{{$errors->first('jourAnnuel')}}</div>
                      @endif
                    </div>
                    <div class="form-group">
                        <label for="cause">Cause
                        </label>
                        <input type="text" class="form-control @if($errors->has('cause')) is-invalid @endif " name="cause" value="{{old('cause')}}"/>
                        @if($errors->has('cause'))
                        <div class="invalid-feedback">{{$errors->first('cause')}}</div>
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