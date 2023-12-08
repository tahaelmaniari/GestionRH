@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
      <h1>La liste des congés</h1>
      <div class="float-right">
        <a href="{{route('conges.index')}}" class="btn btn-dark">Revenir</a>
    </div>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
<div class="form-group float-right">
  <a href="{{route('conges.create')}}" class="bnt btn-success py-2 px-2">Ajouter un congé</a>
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
                    <th>Nom Employe</th>
                    <th>Type Congé</th>
                    <th>Date debut</th>
                    <th>Date fin</th>
                    <th>Nombre de congé Demandé</th>
                    <th>Nombre de congé Resté</th>
                </thead>
                <tbody>
                    <tr>
                      @if($conge->employe->photo)
                      <td><img src="{{asset('upload/employe/'.$conge->employe->photo)}}" class="rounded float-left" width="50px" height="50px" alt="Image User"></td>
                      @else 
                      <td><img src="{{asset('upload/Image/anonymous.png')}}"class="rounded float-left" width="50px" height="50px" alt="Image User"></td>
                      @endif
                        <td>{{$conge->employe->nom}} {{$conge->employe->prenom}}</td>
                        <td>{{$conge->typeConge->nom}}</td>
                        <td>{{$conge->dateDebut}}</td>
                        <td>{{$conge->dateFin}}</td>
                        <td>{{$conge->nombreCongeDemande}}</td>
                        <td>{{$conge->employe->nombreConge}}</td>
                        <td>
                            <div class="d-flex">
                            <a href="{{route('conges.index')}}" class="btn btn-primary btn-sm"style="width:30px;margin-left:20px;height:30px;">
                                <i class="fas fa-undo-alt"></i></a>
                                <!--
                                <a href="{{route('conges.edit',['id' => $conge->id]) }}" class="btn btn-warning btn-sm" style="width:30px;margin-left:20px;height:30px;">
                                    <i class="fas fa-edit"></i></a>
                                -->
                                    <form method="POST" action="{{ route('conges.destroy',$conge->id)}}" class="form-group" id="formDelete">
                                    @csrf 
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-sm destroy" style="width:30px;margin-left:20px;height:30px;">
                                        <i class="fas fa-trash-alt"></i></button>
                                    </div>
                                  </form>
                                    @if($conge->status == 1 and auth()->user()->role =='user')
                                    <div class="d-flex ml-4">
                                      <i class="fas fa-check mt-2 bg-green" style="height:25px;font-size:30px;"></i>
                                      <h4 class="mt-2 ml-2">Validé</h4>
                                  </div>
                                    @endif
                                
                                    @if(auth()->user()->role == 'admin' and $conge->status == 0)
                                    <form action="{{route('conges.validation',['id' => $conge->id])}}" method="POST" id="formValidation">
                                      @csrf
                                      @method('POST')
                                      <button class="btn btn-success ml-2 form-control confirmation"style="padding:5px;margin-bottom:5px;" onclick="confirmationConge(event,{{$conge->id}})">Valider</button>
                                    </form>  
                                  @endif
                                  @if(auth()->user()->role == 'admin' and $conge->status == 0)
                                  <form action="{{route('conges.annuler',['id' => $conge->id])}}" class="form-group" method="post" id="formAnnuler">
                                  @csrf
                                  @method('post')
                                  <button type="submit" class="btn btn-dark ml-2 form-control annulerConge" onclick="annulerConge(event,{{$conge->id}})" style="padding:5px;" >
                                  Invalider
                                  </button>
                                  </form>
                                  @endif
                                  @if(auth()->user()->role == 'user' and $conge->status == 2)
                                  <form action="{{route('conges.congeAnnuler',['id' => $conge->id])}}" method="get">
                                  @csrf 
                                  @method("get")
                                  <button class="btn btn-dark ml-2 form-control" style="height:35px;">Cause</button>
                                  </form>
                                @endif
                                @if ($conge->status == 2 and auth()->user()->role == 'user')
                                <div class="d-flex ml-4">
                                  <i class="fas fa-exclamation-triangle mt-2 bg-red" style="height:40px;font-size:30px;"></i>
                                  <h4 class="mt-3 ml-2">InValidé</h4>
                              </div>
                              @endif
                                @if($conge->status == 2 and auth()->user()->role == 'admin')
                                <button class="btn btn-primary form-control ml-2"style="height:35px;width:90px;left:10px;" disabled="true">Invalider</button>
                                @endif
                                @if($conge->status == 1 and auth()->user()->role == 'admin')
                                <button class="btn btn-success form-control ml-2"style="height:35px;width:90px;" disabled="true">Valider !</button>
                                @endif
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
$('.select2').select2()
$('.select2bs4').select2({
  theme: 'bootstrap4'
});
$('.destroy').click(function(event,id)
{
event.preventDefault();
let parentForm = $(this).parent();
Swal.fire({
title: 'Vous etes sure ?',
text: "Vous voullez supprimer ce congé !",
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
parentForm.submit();
}
})
})
    function confirmationConge(event,id)
    {
      event.preventDefault();
      let formParent = document.getElementById('formValidation');
Swal.fire({
  title: 'Etes vous sure de valider votre congé ?',
  showCancelButton: true,
  confirmButtonText: `Valider`,
}).then((result) => {
  /*Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire('Validé!', '', 'success')
    formParent.submit();
  } else if (result.isDenied) {
    Swal.fire('InValidé', '', 'info')
  }
})
function annulerConge(event,id)
    {
      event.preventDefault();
      let formParent = document.getElementById('formAnnuler');
Swal.fire({
  title: 'Invalider le congé ?',
  showCancelButton: true,
  confirmButtonText: `Oui`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire('Congé invalidé !', '', 'success')
    formParent.submit();
  } else if (result.isDenied) {
    Swal.fire('Congé ni valié ni invalidé', '', 'info')
  }
}) 
}
</script>    
@endsection
