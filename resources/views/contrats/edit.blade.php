@extends('layouts.app')

@section('content')
<div class="card py-2 px-2">
  <div class="float-right" style="margin-left: 900px;">
    <a href="{{route('contrats.index')}}" class="btn btn-dark">Revenir</a>
</div>
<div class="card-title">
<h2>Modifier </h2>
</div>
<div class="container">
<div class="row">
<div class="col-md-6">
<form action="{{route('contrats.update',['id'=> $contrat->id])}}" method="post" enctype="multipart/form-data">
@csrf
@method("put")
<div class=" @if($errors->has('typeContrat')) is-invalid @endif " >
  <label for="typeContrat">Type de contrat</label>
  <select class="form-control select2
   @if($errors->has('typeContrat')) is-invalid @endif"
   name="typeContrat" id="typeContrat">
   @foreach($contrats->unique('typeContrat') as $c) 
   <option value="{{$contrat->typeContrat}}"
    @if (old('typeContrat') == $c->id) selected="selected" @endif
    >
      {{$c->typeContrat}}
  </option>
  @endforeach
  </select>  
    <label for="dateContrat">Date de Contrat</label>
    <input type="date" class="form-control @if($errors->has('dateContrat')) is-invalid @endif "name="dateContrat" value="{{$contrat->dateContrat}}"/>
    @if($errors->has('dateContrat'))
    <div class="invalid-feedback">{{$errors->first('dateContrat')}}</div>
    @endif
</div>
    <button class="btn btn-primary mt-2">S'enregistrer</button>
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
