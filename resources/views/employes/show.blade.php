@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
      <h2>{{$employe->nom}} {{$employe->prenom}}</h2>
      <div class="float-right">
          <a href="{{route('employes.index')}}" class="btn btn-dark">Revenir</a>
      </div>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
<div class="form-group float-right">
  <a href="{{route('employes.create')}}" class="bnt btn-success py-2 px-2">Ajouter un employé</a>
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
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Ville</th>
                    <th>Nombre Congé</th>
                    <th>Date Debut</th>
                    <th>Date Fin</th>
                    <th>Specialité</th>
                    <th class="text-center">Actions</th>
                </thead>
                <tbody>
                    <tr>
                        @if($employe->photo)
                        <td><img src ="{{asset('upload/employe/'. $employe->photo)}}" alt="User image" class="rounded float-left" width="50px" height="50px"/></td>
                        @else
                        <td><img src="{{asset('Image/employe1.png')}}" class="rounded float-left" width="50px" height="50px"/></td>
                        @endif
                        <td>{{$employe->nom}} {{ $employe->prenom }}</td>
          <td>{{$employe->ville}}</td>
          <td>{{$employe->nombreConge}}</td>
          <td>{{$employe->dateDebut}}</td>
          <td>{{$employe->dateFin}}</td>
          <td>{{$employe->specialite}}</td>
                        <td>
                            <div class="d-flex">
                            <a href="{{route('employes.index')}}" class="btn btn-primary btn-sm"style="width:30px;margin-left:20px;height:30px;">
                                <i class="fas fa-undo-alt"></i></a>
                                <form method="POST" action="{{ route('employes.destroy', $employe->id) }}" class="form-group ">
                                    @csrf 
                                    {{ method_field('DELETE') }}
                                    <button type="submit" onclick="deleteConfirmation({{$employe->id}})" class="btn btn-danger btn-sm destroy" style="width:30px;margin-left:20px;height:30px;">
                                        <i class="fas fa-trash-alt"></i></button>
                                    </div>
                                    </td>
                    </tr>
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
$('.destroy').click(function(event)
{
event.preventDefault();
let parentForm = $(this).parent();
Swal.fire({
title: 'Vous etes sure ?',
text: "Vous voullez supprimer cet utliisateur!",
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
