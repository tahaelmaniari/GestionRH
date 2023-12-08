@extends('layouts.app')
@section('content')
    <div class="card card-default">
      <div class="card-header">
        <h1>La liste des congés</h1>
        @if(Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
        @endif
      @if(Session::has('info'))
      <div class ="alert alert-danger">{{Session::get('info')}}</div>
      @endif
      @if(Session::has('validation'))
      <p class="alert alert-success">{{ Session::get('validation') }}</p>
      @endif
      @if(Session::has('messageEnvoye'))
      <p class="alert alert-info">{{ Session::get('messageEnvoye') }}</p>
      @endif
      @if(Session::has('redemanderConge'))
      <p class="alert alert-success">{{ Session::get('redemanderConge') }}</p>
      @endif
      @if(Session::has('impossibleValider'))
      <p class="alert alert-danger">{{ Session::get('impossibleValider') }}</p>
      @endif
      @if(Session::has('tentative'))
      <p class="alert alert-danger">{{ Session::get('tentative') }}</p>
      @endif
      @if(Session::has('deletedConge'))
      <p class="alert alert-success">{{ Session::get('deletedConge') }}</p>
      @endif
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="container">
      </div>
<div class="form-group text-right">
    <a href="{{route('conges.create')}}" class="bnt btn-success py-2 px-2">Demander un congé</a>
</div>
        <div class="row">
          <div class="col-md-12">
            <form action="" method="get">
              @csrf
              @method('get')
              <div class="col-4 py-3 ">
                     <div class="input-group">
                     <div class="form-outline">
                     <div class="d-flex">
                     <input type="date" class="form-control" placeholder="Date Debut..." name="dateDebut" value={{Request::get('dateDebut')}}>
                      </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-4 py-3">
                              <div class="input-group">
                              <div class="form-outline">
                                  <div class="d-flex">
                                <input type="date" class="form-control" placeholder="Date Fin..." name="dateFin" value={{Request::get('dateFin')}} >
                              <button class="btn btn-primary ml-3">
                                <i class="fas fa-search" ></i>  
                              </button>    
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
      </form>
      </div>
  <table class="table table-stripped mt-2 ml-2">
  <thead>
  <tr>
<th></th>
<th>Nom Employe</th>
<th>Type Congé</th>
<th>Date Debut</th>
<th>Date Fin</th>
<th>Nombre de congé demandé</th>
<th>Nombre de congé resté</th> 
<th>Status</th>
<th class="text-center">Actions</th>
  </tr>
  </thead>
  <tbody>
  @if(count($conges)>0)
  @foreach($conges as $conge)
  <tr>
        @if($conge->employe->photo)
          <td><img src ="{{asset('upload/employe/'. $conge->employe->photo)}}" alt="Employe image" class="rounded float-left" width="50px" height="50px"/></td>
          @else
          <td><img src="{{asset('Image/employe1.png')}}" class="rounded float-left" width="50px" height="50px"/></td>
          @endif
          <td>{{$conge->employe->nom}} {{$conge->employe->prenom}}</td>
          <td>{{$conge->typeConge->nom}}</td>
          <td>{{$conge->dateDebut}}</td>
          <td>{{$conge->dateFin}}</td>
          <td>{{$conge->nombreCongeDemandeEmploye}}</td>
          @if($conge->employe->nombreConge)
          <td>{{$conge->employe->nombreConge}}</td>
          @else 
          <td>50</td>
          @endif
          @if($conge->status == 0)
          <td>Attente...</td>
          @elseif($conge->status == 1) 
          <td>Confirmé</td>
          @else 
          <td>Non Confirmé</td>
          @endif             
          <td class ="d-flex ml-5 ">
              <a href="{{route('conges.show', ['id'  => $conge->id]) }}" class="btn btn-primary btn-sm " style="width:30px;height:30px">
                  <i class="fas fa-eye"></i></a>
                  <a href="{{route('conges.edit',['id' => $conge->id]) }}" class="btn btn-warning btn-sm ml-2" style="width:30px;height:30px">
                      <i class="fas fa-edit"></i></a>
                  <form action="{{route('conges.destroy',['id' => $conge->id])}}" method="post" class="form-group">
                      @csrf 
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger ml-2 destroy" style="width:30px;height:30px;padding:5px;" >
                          <i class="fas fa-trash-alt"></i>
                      </button>
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
                    <button class="btn btn-success ml-2 confirmation"style="padding:5px;width:30px;height:30px" onclick="confirmationConge(event,{{$conge->id}})">
                      <i class="fas fa-check"></i>
                    </button>
                  </form>  
                @endif
                @if(auth()->user()->role == 'admin' and $conge->status == 0)
                <form action="{{route('conges.annuler',['id' => $conge->id])}}" class="form-group" method="post" id="formAnnuler">
                @csrf
                @method('post')
                <button type="submit" class="btn btn-danger ml-2 form-control annulerConge" onclick="annulerConge(event,{{$conge->id}})" style="padding:3px;height:30px" >
                Invalider
                </button>
                </form>
                @endif
                @if(auth()->user()->role == 'user' and $conge->status == 2)
                <form action="{{route('conges.congeAnnuler',['id' => $conge->id])}}" method="get">
                @csrf 
                @method("get")
                <button class="btn btn-dark ml-3 form-control" style="height:35px">
                  <i class="fas fa-question"></i>
                </button>
                </form>
              @endif
              @if ($conge->status == 2 and auth()->user()->role == 'user')
              <div class="d-flex ml-4">
                <i class="fas fa-exclamation-triangle mt-0 bg-red" style="height:35px;font-size:30px;"></i>
              <h4 style="font-size:16px;margin-top:3px;">Invalidé</h4>
            </div>
            @endif
              @if($conge->status == 2 and auth()->user()->role == 'admin')
              <button class="btn btn-primary form-control ml-2"style="height:35px;width:90px;" disabled="true">Invalider</button>
              @endif
              @if($conge->status == 1 and auth()->user()->role == 'admin')
              <button class="btn btn-success form-control ml-2"style="height:35px;width:40px;" disabled="true">
                <i class="fas fa-check"></i>
              </button>
              @endif
              <!--
              <a href="{{route('conges.pdfOmia',['id' => $conge->id])}}" class="btn btn-dark ml-3" style="width:40px;height:35px">
                <i class="fas fa-file-pdf"></i>
              </a>
              -->
          </td>
      </tr>
      @endforeach
      @else     
      <tr>
          <td colspan="4"><strong>Aucun congé demandé</strong></td>
      </tr>
      @endif
  </tbody>
  </table>
  <div class="float-right mt-2">{{$conges->links()}}</div>
        </div>
      </div>
@endsection
@section('js')
<script>//Initialize Select2 Elements
    $('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    $('.destroy').click(function(event)
{
event.preventDefault();
let parentForm = $(this).parent();
Swal.fire({
title: 'Vous etes sure ?',
text: "Vous voullez supprimer ce congé!",
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
function confirmationConge(event,id)
    {
      event.preventDefault();
      let formParent = document.getElementById('formValidation');
Swal.fire({
  title: 'Etes vous sure de valider votre congé ?',
  showCancelButton: true,
  confirmButtonText: `Valider`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire('Validé!', '', 'success')
    formParent.submit();
  } else if (result.isDenied) {
    Swal.fire('InValidé', '', 'info')
  }
})
    }
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