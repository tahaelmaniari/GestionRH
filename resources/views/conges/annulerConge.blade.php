@extends('layouts.app')
@section('content')
<div class="card py-2 px-2">
    <div class="float-right" style="margin-left: 900px;">
        <a href="{{route('conges.index')}}" class="btn btn-dark">Revenir</a>
    </div>
<div class="card-title">
<h2>Cause d'annulation de congé</h2>
</div>
<div class="container">
<div class="row">
<div class="col-md-6">
    @if(auth()->user()->role == 'admin')
<form action="{{route('conges.annulerConge',['id'=> $conge->id])}}" method="post" enctype="multipart/form-data">
@csrf
@method("post")
<textarea name="cause" cols="10" autofocus="true" rows="3" class="form-control @if($errors->has('cause')) is-invalid @endif" >{{old('cause')}}</textarea>
@if($errors->has('cause'))
<div class="invalid-feedback">{{$errors->first('cause')}}</div>
@endif
<button type="submit"class="btn btn-primary mt-2 ml-3" >Envoyer la cause</button>
</form>
@else
<textarea name="cause" cols="10" rows="3" class="form-control @if($errors->has('cause')) is-invalid @endif">{{old('cause')}}</textarea>
@if($errors->has('cause'))
<div class="invalid-feedback">{{$errors->first('cause')}}</div>
@endif
<a href="{{route('conges.index')}}" class="btn btn-dark">Revenir</a>
@endif
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