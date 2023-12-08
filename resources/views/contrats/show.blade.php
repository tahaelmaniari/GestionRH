@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
      <h1>Le contrat Numero {{$contrat->id}}</h1>
      <div class="float-right">
        <a href="{{route('contrats.index')}}" class="btn btn-dark">Revenir</a>
      </div>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
<div class="form-group float-right">
  <a href="{{route('contrats.create')}}" class="bnt btn-success py-2 px-2">Ajouter un contrat</a>
</div>
@if(Session::has('success'))
<p class="alert alert-info">{{ Session::get('success') }}</p>
@endif
@if(Session::has('good'))
<div class="alert-alert-info">{{Session::get('good')}}</div>
@endif
      <div class="row">
        <div class="col-md-12">
            <table class="table table-stripped">
                <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Type Contrat</th>
                    <th>Date de contrat</th>
                    <th>Nom Employe</th>
                    <th class="text-center">Actions</th>
                </thead>
                <tbody>
                    @if(auth()->user()->role == 'admin')
                    <tr>
                    @if($contrat->employe->photo)
                    <td><img src ="{{asset('upload/employe/'. $contrat->employe->photo)}}" alt="Employe image" class="rounded float-left" width="50px" height="50px"/></td>
                    @else
                    <td><img src="{{asset('Image/employe1.png')}}" class="rounded float-left" width="50px" height="50px"/></td>
                    @endif
                        <td>{{$contrat->id}}</td>
                        <td>{{$contrat->typeContrat}}</td>
                        <td>{{$contrat->dateContrat}}</td>
                        <td>{{$contrat->employe->nom}} {{$contrat->employe->prenom}}</td>
                        <td>
                            <div class="d-flex">
                            <a href="{{route('contrats.index')}}" class="btn btn-primary btn-sm"style="width:30px;margin-left:20px;height:30px;">
                                <i class="fas fa-undo-alt"></i></a>
                                <a href="{{route('contrats.edit',['id' => $contrat->id]) }}" class="btn btn-warning btn-sm" style="width:30px;margin-left:20px;height:30px;">
                                    <i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('contrats.destroy', $contrat->id) }}" class="form-group ">
                                    @csrf 
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm destroy" style="width:30px;margin-left:20px;height:30px;">
                                        <i class="fas fa-trash-alt"></i></button>
                                    </div>
                                    </td>
                    </tr>
                    @else 
                    <tr>
                        <td>{{$contrat->id}}</td>
                        <td>{{$contrat->typeContrat}}</td>
                        <td>{{$contrat->dateContrat}}</td>
                        <td>{{$contrat->employe->nom}}</td>
                        <td>
                            <div class="d-flex">
                            <a href="{{route('contrats.index')}}" class="btn btn-primary btn-sm"style="width:30px;margin-left:20px;height:30px;">
                                <i class="fas fa-undo-alt"></i></a>
                                    </td>
                    @endif 
                </tbody>
            </table>
        </div>
    </div>
    
</div>
      </div>
      @endsection
@section('js')
<script>
$('.select2zz').select2()
$('.select2bs4').select2({
  theme: 'bootstrap4'
});
$('.destroy').click(function(event,id)
{
event.preventDefault();
let parentForm = $(this).parent();
Swal.fire({
title: 'Vous etes sure ?',
text: "Vous voullez supprimer ce contrat!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Oui,supprimez !',
}).then((result) => {
if (result.isConfirmed){
Swal.fire(
'Supprimer!',
'Les informations ont bien éte supprimés.',
'success',
)
parentForm.submit()
}
})
})
</script>
@endsection