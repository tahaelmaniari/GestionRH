@extends('layouts.app')
@section('content')
<div class="card py-2 px-2">
    <div class="float-right" style="margin-left: 900px;">
        <a href="{{route('soldes.index')}}" class="btn btn-dark">Revenir</a>
    </div>
<div class="card-title">
<h2>Modification du solde</h2>
</div>
<div class="container">
<div class="row">
<div class="col-md-6">
<form action="{{route('soldes.update',['id'=> $solde->id])}}" method="post" enctype="multipart/form-data">
@csrf
@method("put")
<div class="form-group @if($errors->has('typeConge_id')) is-invalid @endif">
    <label>Employe Nom</label>
    <div class="  @if($errors->has('employe_id')) is-invalid @endif" >
      <select class="form-control select2
       @if($errors->has('employe_id')) is-invalid @endif"
       name="typeConge_id" id="typeConge_id">
        <option value="{{$employe->id}}"
            @if (old('employe_id') == $employe->id) selected="{{$employe->nom}}" @endif
            >
          {{$employe->nom}}</option>
        </select>  
       @if($errors->has('employe_id'))
    <div class="invalid-feedback">{{$errors->first('employe_id')}}</div>
    @endif
    </div>
    <div class="form-group">
        <label for="jourAnnuel">Jour Annuel</label>
        <input type="number" class="form-control @if($errors->has('jourAnnuel')) is-invalid @endif "name="jourAnnuel" value="{{$solde->jourAnnuel}}"/>
        @if($errors->has('jourAnnuel'))
        <div class="invalid-feedback">{{$errors->first('jourAnnuel')}}</div>
        @endif
        </div>
        <div class="form-group">
            <label for="cause">Cause</label>
            <input type="text" class="form-control @if($errors->has('cause')) is-invalid @endif "name="cause" value="{{$solde->cause}}"/>
            @if($errors->has('cause'))
            <div class="invalid-feedback">{{$errors->first('cause')}}</div>
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