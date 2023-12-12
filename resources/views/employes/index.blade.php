@extends('layouts.app')
@section('content')
    <div class="card card-default">
      <div class="card-header">
        <h1>La liste des employés</h1>
        @if(Session::has('success'))
<p class="alert alert-info">{{ Session::get('success') }}</p>
@endif
@if(Session::has('employeDeleted'))
<p class="alert alert-success">{{ Session::get('employeDeleted') }}</p>
@endif
@if(Session::has('good'))
<div class="alert alert-info">{{Session::get('good')}}</div>
@endif
@if(Session::has('changedRole'))
<div class="alert alert-info">{{Session::get('changedRole')}}</div>
@endif
@if (auth()->user()->role == 'admin')
<div class="form-group text-right ml-5">
  <a href="{{route('employes.create')}}" style="width:30px;height:30px;" class="bnt btn-success py-2 px-2">
  Ajouter un Employé
    <i class="fas fa-plus ml-2"></i>
  </a>
</div>
    
@endif
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <form action="" method="get">
              @csrf
              @method('get')
                  <div class="input-group">
                  <div class="form-outline">
                      <div class="d-flex">
                    <input type="search" class="form-control" placeholder="Nom..." name="nom" value={{Request::get('nom')}} >
              </div>
                </div>
              </div>
            </div>
          <div class="col-3 py-3">
                      <div class="input-group">
                      <div class="form-outline">
                      <div class="d-flex">
                        <input type="search" class="form-control" placeholder="Prenom..." name="prenom" value={{Request::get('prenom')}}>
                  </div>
                    </div>
                  </div>
              </div>
              <div class="col-3 py-3 ">
                     <div class="input-group">
                     <div class="form-outline">
                     <div class="d-flex">
                     <input type="search" class="form-control" placeholder="Ville..." name="ville" value={{Request::get('ville')}}>
                      </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-3 py-3">
                              <div class="input-group">
                              <div class="form-outline">
                                  <div class="d-flex">
                                <input type="search" class="form-control" placeholder="Adresse..." name="adresse" value={{Request::get('adresse')}} >
                          </div>
                            </div>
                          </div>
                      </div>
                      <div class="col-3 mt-2">
                          <div class="input-group">
                          <div class="form-outline">
                              <div class="d-flex mt-2 ">
                            <input type="search" class="form-control ml-2" placeholder="NumeroTelephone..." name="numeroTelephone" value={{Request::get('numeroTelephone')}} >
                      </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-3 mt-2">
                      <div class="input-group">
                      <div class="form-outline">
                          <div class="d-flex">
                        <input type="date" class="form-control" placeholder="Date Debut..." name="dateDebut" value={{Request::get('dateDebut')}} >
                      </button>
                  </div>
                    </div>
                  </div>
              </div>
              <div class="col-3">
                  <div class="input-group">
                  <div class="form-outline">
                      <div class="d-flex mt-2">
                    <input type="date" class="form-control" placeholder="Date Fin..." name="dateFin" value={{Request::get('dateFin')}} >
              </div>
                </div>
              </div>
          </div>
          <div class="col-3 mt-1">
              <div class="input-group">
              <div class="form-outline">
                  <div class="d-flex">
                <input type="search" class="form-control" placeholder="Specialité..." name="specialite" value={{Request::get('specialite')}} >
                  <button class="btn btn-primary" style="margin-left:20px;height:40px; margin-top :10px;">
                <i class="fas fa-search" ></i>
              </button>
          </div>
            </div>
          </div>
      </div>
      </form>
      </div>
  <table class="table table-stripped mt-2 ml-2">
  <thead>
  <tr>
  <th>Photo</th>
  <th>Nom</th>
  <th>Ville</th>
  <th>Adresse</th>
  <th>Nombre de Congé</th>
  <th>Date de debut</th>
  <th>Role</th>
  <th>Specialité</th>
  <th class="text-center">Actions</th>
  </thead>
  <tbody>
  @if(count($employes)>0)
  @foreach($employes as $employe)
      <tr>
          @if($employe->photo)
          <td><img src ="{{asset('upload/employe/'. $employe->photo)}}" alt="Employe image" class="rounded float-left" width="50px" height="50px"/></td>
          @else
          <td><img src="{{asset('Image/employe1.png')}}" class="rounded float-left" width="50px" height="50px"/></td>
          @endif
          <td>{{$employe->nom}} {{$employe->prenom}}</td>
          <td>{{$employe->ville}}</td>
          <td>{{$employe->adresse}}</td>
          <td>{{$employe->nombreConge}}</td>
          <td>{{$employe->dateDebut}}</td>
          <td>{{$employe->role}}</td>
          <td>{{$employe->specialite}}</td>
          @if(auth()->user()->role == 'admin')
          <td class ="d-flex ml-5 ">
              <a href="{{route('employes.show', ['id'  => $employe->id]) }}" class="btn btn-primary btn-sm " style="width:30px;height:30px">
                  <i class="fas fa-eye"></i></a>
                  <a href="{{route('employes.edit',['id' => $employe->id]) }}" class="btn btn-warning btn-sm ml-2" style="width:30px;height:30px">
                      <i class="fas fa-edit"></i></a>
                  <form action="{{route('employes.destroy',['id' => $employe->id])}}" method="post" class="form-group">
                      @csrf 
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger ml-2 destroy" style="width:30px;height:30px;padding:5px;" >
                          <i class="fas fa-trash-alt"></i>
                      </button>
                  </form>
                  @if(auth()->user()->role == 'admin')
                  @if($employe->role == 'admin')
                  <form action="{{route('employes.changeAdmin',['id' => $employe->id])}}" method="post" class="form-group">
                      @csrf 
                      @method('POST')
                      <button type="submit" class="btn btn-dark ml-2 changeUser" style="width:30px;height:30px;padding:3px;" >
                      U
                      </button>
                  </form>
                  @else
                  <form action="{{route('employes.changeRole',['id' => $employe->id])}}" method="post" class="form-group">
                      @csrf 
                      @method('POST')
                      <button type="submit" class="btn btn-info ml-2 changeAdmin" style="width:30px;height:30px;padding:3px;" >
                      A
                      </button>
                  </form>
                  @endif
                  @endif                  

          </td>
          @else 

          @endif
      </tr>
      @endforeach      
      @else
      <tr>
          <td colspan="10"><strong>Aucun employé trouvé</strong></td>
      </tr>
      @endif
  </tbody>
  </table>
  <div class="float-right mt-2">{{$employes->links()}}</div>
      </div>
      <div class="container">
        <a href="{{route('employes.pdf')}}" class="btn btn-dark">Extraire la liste en pdf</a>
      </div>
@endsection
@section('js')
<script>//Initialize Select2 Elements
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
text: "Vous voullez supprimer cet employé ?",
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

$('.changeAdmin').click(function(event)
{
event.preventDefault();
let parentForm = $(this).parent();
Swal.fire({
title: 'Vous etes sure de changer vers admin ?',
text: "Vous voullez changer le role vers admin ?",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Oui,Changez !',
}).then((result) => {
if (result.isConfirmed){
  Swal.fire(
    'Modifier!',
    'Modification avec succés vers admin.',
    'success',
  )
 parentForm.submit()
}
})
})


$('.changeUser').click(function(event)
{
event.preventDefault();
let parentForm = $(this).parent();
Swal.fire({
title: 'Vous etes sure de changer vers user ?',
text: "Vous voullez changer le role vers user ?",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Oui,Changez !',
}).then((result) => {
if (result.isConfirmed){
  Swal.fire(
    'Modifier!',
    'Modification avec succés vers user.',
    'success',
  )
 parentForm.submit()
}
})
})


</script>
@endsection