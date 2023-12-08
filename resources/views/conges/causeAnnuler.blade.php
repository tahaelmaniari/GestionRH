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
    @if(auth()->user()->role == 'user')
<textarea name="cause" cols="10" autofocus="true" rows="3" class="form-control" disabled="true">{{$cause}}</textarea>
<form action="{{route('conges.redemanderConge',['id' => $conge->id])}}" method="post">
@csrf
@method('post')
@if($conge->tentative <=3)
<button class="btn btn-success mt-2 ml-2">Redemander votre congé</button>
@else 
<button class="btn btn-success mt-2 ml-2" disabled="true">Redemander votre congé</button>
@endif
</form>
@endif
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
