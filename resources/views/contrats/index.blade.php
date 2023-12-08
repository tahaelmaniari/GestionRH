@extends('layouts.app')
@section('content')
<h1>La liste des contrats</h1>
<div class="card my-5 ml-2">
  @if(Session::has('success'))
  <p class="alert alert-info">{{ Session::get('success') }}</p>
  @endif
  @if(Session::has('info'))
  <p class="alert alert-info">{{ Session::get('info') }}</p>
  @endif
  @if(Session::has('error'))
  <p class="alert alert-danger">{{ Session::get('error') }}</p>
  @endif
  @if(Session::has('ajout'))
  <p class="alert alert-success">{{ Session::get('ajout') }}</p>
  @endif
  @if(Session::has('updatedContrat'))
  <p class="alert alert-success">{{ Session::get('updatedContrat') }}</p>
  @endif
<div class="card card-default">
  <div class="card-header">
    <h1 class="card-title"></h1>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    @if(auth()->user()->role == 'admin')
    <div class="form-group float-right">
      <a href="{{route('contrats.create')}}" class="bnt btn-success py-2 px-2">Ajouter un contrat</a>
  </div>
  @else
  @endif
    <div class="row">
      <div class="col-md-12">
          <form action="" method="get">
              @csrf
              @method('get')
              <div class="d-flex">
          <div class="col-4">
                      <div class="input-group">
                      <div class="form-outline">
                      <div class="d-flex">
                        <input type="search" class="form-control" placeholder="Type contrat..." name="typeContrat" value={{Request::get('typeContrat')}}>
                  </div>
                    </div>
                  </div>
              </div>
              <div class="col-4">
                     <div class="input-group">
                     <div class="form-outline">
                     <div class="d-flex">
                     <input type="date" class="form-control" placeholder="Date de contrat..." name="dateContrat" value={{Request::get('dateContrat')}}>
                      </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-4">
                              <div class="input-group">
                              <div class="form-outline">
                                  <div class="d-flex">
                                    <div class="  @if($errors->has('employe_id')) is-invalid @endif" >
                                        <select class="form-control select2
                                         @if($errors->has('employe_id')) is-invalid @endif"
                                         name="employe_id" id="employe_id">
                                          <option value=""
                                           class="form-control">
                                           Veuillez choisir un employé</option>
                                          </div>
                                          @if (auth()->user()->role == 'admin')
                                          @foreach($employes as $employe)
                                          <option value="{{$employe->id}}">
                                            {{$employe->nom}} {{$employe->prenom}}</option>
                                                @endforeach
                                                @else 
                                                <option value="{{auth()->user()->id}}">{{auth()->user()->name}} {{auth()->user()->prenom}}</option>
                                                @endif
                                        </select>   @if($errors->has('employe_id'))
                                      <div class="invalid-feedback">{{$errors->first('employe_id')}}</div>
                                      @endif
                                      </div>
                                  <button class="btn btn-primary" style="margin-left:20px;height:40px;">
                                <i class="fas fa-search" ></i>
                              </button>
                          </div>
                            </div>
                          </div>
                      </div>
                    </div>
                    </form>
<table class="table table-striped mt-2 ml-2">
<thead>
<tr>
<th></th>
<th>Nom</th>
<th>Date de Contrat</th>
<th>Type Contrat</th>
<th class="text-center">Actions</th>
</thead>
<tbody>
    @if(count($contrats) >0)
    @foreach($contrats as $contrat)
    <tr>
        @if($contrat->employe->photo)
          <td><img src ="{{asset('upload/employe/'. $contrat->employe->photo)}}" alt="Employe image" class="rounded float-left" width="50px" height="50px"/></td>
          @else
          <td><img src="{{asset('Image/employe1.png')}}" class="rounded float-left" width="50px" height="50px"/></td>
          @endif
        <td>{{$contrat->employe->nom}} {{$contrat->employe->prenom }}</td>
        <td>{{$contrat->dateContrat}}</td>
        <td>{{$contrat->typeContrat}}</td>
        <td class ="d-flex ml-5 ">
            <a href="{{route('contrats.show', ['id'  =>$contrat->id]) }}" class="btn btn-primary btn-sm " style="width:30px;height:30px">
                <i class="fas fa-eye"></i></a>
                <a href="{{route('contrats.edit',['id' => $contrat->id]) }}" class="btn btn-warning btn-sm ml-2" style="width:30px;height:30px">
                    <i class="fas fa-edit"></i></a>
                <form action="{{route('contrats.destroy',['id' => $contrat->id])}}" method="post" class="form-group" id="form-delete">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ml-2 destroy" onclick="deleteConfirmation(event,{{$contrat->id}})"style="width:30px;height:30px;padding:5px;" >
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
        </td>
    </tr>
    @endforeach
    @else
        <td colspan="4">Aucun contrat trouvé pour le moment</td>
    @endif
</tbody>
</table>
</div>
<div class="float-right">
  {{$contrats->links()}}
</div>
<div class="container">
  <a href="{{route('contrats.pdf')}}" class="btn btn-dark">Extraire la liste en pdf</a>
</div>
</div>
@endsection
@section('js')
<script>
  function deleteConfirmation(event,id)
  {
const destroy = document.getElementById('destroy');
Swal.fire({
title: 'Vous etes sure ?',
text: "Vous voullez supprimer cet utliisateur!",
icon: 'Attention',
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
  destroy.parentElement.submit();
}
})
}
$('.destroy').click(function(event)
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
$('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
</script>
    
@endsection