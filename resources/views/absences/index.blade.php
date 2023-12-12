@extends('layouts.app')
@section('content')
    <div class="card card-default">
      <div class="card-header">
        <h1>La liste des Absences</h1>
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
      @if(Session::has('absenceValide'))
      <p class="alert alert-success">{{ Session::get('absenceValide') }}</p>
      @endif
      @if(Session::has('tentative'))
      <p class="alert alert-danger">{{ Session::get('tentative') }}</p>
      @endif
      @if(Session::has('deletedConge'))
      <p class="alert alert-success">{{ Session::get('deletedConge') }}</p>
      @endif
      @if(Session::has('absenceNonAutorise'))
      <p class="alert alert-info">{{ Session::get('absenceNonAutorise') }}</p>
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
    <a href="{{route('absences.create')}}" class="bnt btn-success py-2 px-2">Demander une Absence</a>
</div>
        <div class="row">
          <div class="col-md-12">
            <form action="" method="get">
              @csrf
              @method('get')
                  <div class="col-4 py-3">
                              <div class="input-group">
                              <div class="form-outline">
                                  <div class="d-flex">
                                <input type="text" class="form-control" placeholder="Motif..." name="motif" value={{Request::get('motif')}} >
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
    @if(auth()->user()->role == 'admin')
    <th>Image</th>
    <th>Nom Complet</th>
    @endif
<th>Motif</th>
<th>Heure Début</th>
<th>Heure Fin Fin</th>
<th>Status</th>
<th class="text-center">Actions</th>
  </tr>
  </thead>
  <tbody>
  @if(count($absences)>0)
  @foreach($absences as $absence)
  <tr>
  @if(auth()->user()->role == 'admin')
  @if($absence->employe->photo)
                <td><img src ="{{asset('upload/employe/'. $absence->employe->photo)}}" alt="Employe image" class="rounded float-left" width="50px" height="50px"/></td>
                @else
                <td><img src="{{asset('Image/employe1.png')}}" class="rounded float-left" width="50px" height="50px"/></td>
                @endif
          <td>{{$absence->employe->nom}} {{$absence->employe->prenom}}</td>
          @endif
          <td>{{$absence->motif}}</td>
          <td>{{$absence->heureDebut}}</td>
          <td>{{$absence->heureFin}}</td>
          @if($absence->status == 0)
          <td>Attente...</td>
          @elseif($absence->status == 1) 
          <td>
            <h5>Confirmé</h5>
          </td>
          @else 
          <td>
          <h5>Non Confirmé</h5>
          </td>
          @endif             
          <td class ="d-flex ml-5 ">
              <a href="{{route('absences.show',$absence) }}" class="btn btn-primary btn-sm " style="width:30px;height:30px">
                  <i class="fas fa-eye"></i></a>
                  <a href="{{route('absences.edit',$absence) }}" class="btn btn-warning btn-sm ml-2" style="width:30px;height:30px">
                      <i class="fas fa-edit"></i></a>
                  <form action="{{route('absences.destroy',$absence)}}" method="post" class="form-group">
                      @csrf 
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger ml-2 destroy" style="width:30px;height:30px;padding:5px;" >
                          <i class="fas fa-trash-alt"></i>
                      </button>
                  </form>
                  @if($absence->status == 1 and auth()->user()->role =='user')
                  <div class="d-flex ml-4">
                    <i class="fas fa-check bg-green" style="height:30px;font-size:30px;"></i>
                    <h4 class="mt-2 ml-2">Validé</h4>
                </div>
                  @endif
                  @if(auth()->user()->role == 'admin' and $absence->status == 0)
                  <form action="{{route('absences.validation',['id' => $absence->id])}}" method="POST" id="formValidation">
                    @csrf
                    @method('POST')
                    <button class="btn btn-success ml-2 confirmation"style="padding:5px;width:30px;height:30px" onclick="confirmationConge(event,{{$absence->id}})">
                      <i class="fas fa-check"></i>
                    </button>
                  </form>  
                @endif
                @if(auth()->user()->role == 'admin' and $absence->status == 0)
                <form action="{{route('absence.annuler',['id' => $absence->id])}}" class="form-group" method="post" id="formAnnuler">
                @csrf
                @method('post')
                <button type="submit" class="btn btn-danger ml-2 form-control annulerConge" onclick="annulerConge(event,{{$absence->id}})" style="padding:3px;height:35px" >
                Invalider
                </button>
                </form>
                
                @endif
                @if(auth()->user()->role == 'user' and $absence->status == 2)
                <form action="{{route('absences.absenceAnnuler',['id' => $absence->id])}}" method="get">
                @csrf 
                @method("get")
                <button class="btn btn-dark ml-3 form-control" style="height:30px">
                  <i class="fas fa-question"></i>
                </button>
                </form>
              @endif
              @if ($absence->status == 2 and auth()->user()->role == 'user')
              <div class="d-flex ml-4">
                <i class="fas fa-exclamation-triangle mt-0 bg-red" style="height:30px;font-size:30px;"></i>
              <h4 style="font-size:16px;margin-top:3px;">Invalidé</h4>
            </div>
            @endif
              @if($absence->status == 2 and auth()->user()->role == 'admin')
              <button class="btn btn-primary form-control ml-2"style="height:35px;width:90px;" disabled="true">Invalider</button>
              @endif
              @if($absence->status == 1 and auth()->user()->role == 'admin')
              <button class="btn btn-success form-control ml-2"style="height:35px;width:40px;" disabled="true">
                <i class="fas fa-check"></i>
              </button>
              @endif
          </td>
      </tr>
      @endforeach
      @else     
      <tr>
          <td colspan="4"><strong>Aucune Absence Demandée</strong></td>
      </tr>
      @endif
  </tbody>
  </table>
  <div class="float-right mt-2">{{$absences->links()}}</div>
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
text: "Vous voullez supprimer cette absence!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Oui,supprimez !',
}).then((result) => {
if (result.isConfirmed){
  Swal.fire(
    'Supprimer!',
    'Cette absence a bien éte supprimés.',
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
  title: 'Etes vous sure de valider cette absence ?',
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
  title: 'Invalider cette absence ?',
  showCancelButton: true,
  confirmButtonText: `Oui`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire('Absence invalidé !', '', 'success')
    formParent.submit();
  } else if (result.isDenied) {
    Swal.fire('Absence ni validé ni invalidé', '', 'info')
  }
}) 
    }
</script>
@endsection