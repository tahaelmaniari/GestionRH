@extends('layouts.app')
@section('content')
    <div class="card card-default">
      <div class="card-header">
        <h1>La liste des soldes</h1>
        @if(Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
        @endif
        @if(Session::has('jourAnnuel'))
        <p class="alert alert-success">{{ Session::get('jourAnnuel') }}</p>
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
      @if(Session::has('tentative'))
      <p class="alert alert-danger">{{ Session::get('tentative') }}</p>
      @endif
      @if(Session::has('deletedSolde'))
      <p class="alert alert-info">{{ Session::get('deletedSolde') }}</p>
      @endif
          @if(Session::has('ajoutJour'))
      <p class="alert alert-info">{{ Session::get('ajoutJour') }}</p>
      @endif
      @if(Session::has('updatedSolde'))
      <p class="alert alert-info">{{ Session::get('updatedSolde') }}</p>
      @endif
      @if(Session::has('increment'))
      <p class="alert alert-info">{{ Session::get('increment') }}</p>
      @endif
      <div class="form-group text-right ml-5">
        <a href="{{route('soldes.create')}}" style="width:30px;height:30px;" class="bnt btn-success py-2 px-2">
        Ajouter un Solde
          <i class="fas fa-plus ml-2"></i>
        </a>
    </div>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
          <div class="container">
        <div class="d-flex">
        <div class="form-group">
          @if(auth()->user()->role == 'admin')
            <form action="{{route('soldes.jourAnnuel')}}" method="post">
            @csrf
            @method('post')
            <label for="jourAnnuel" style="margin-right : 60px;">Jour Annuel :</label>
            <input type="number" step="0.5"class="form-control @if($errors->has('jourAnnuel')) is-invalid @endif " name="jourAnnuel" value="{{old('jourAnnuel')}}"/>
            @if($errors->has('jourAnnuel'))
            <div class="invalid-feedback">{{$errors->first('jourAnnuel')}}</div>
            @endif
            </div>
              <button class="btn btn-secondary" style="height:40px;margin-top:28px;margin-left:10px;">Ajouter les jours annuels aux employés</button>
        </form>
          @endif
        </div>
    </div>
        <div class="row">
          <div class="col-md-12">
            <form action="" method="get">
              @csrf
              @method('get')
                  <div class="input-group">
                  <div class="form-outline">
                      <div class="d-flex">
                    <input type="search" class="form-control" placeholder="Employe ID..." name="employe_id" value={{Request::get('employe_id')}} >
                </div>
                </div>
              </div>
            </div>
          <div class="col-3 py-3">
                      <div class="input-group">
                      <div class="form-outline">
                      <div class="d-flex">
                        <input type="search" class="form-control" placeholder="jourAnnuel..." name="jourAnnuel" value={{Request::get('jourAnnuel')}}>
                  </div>
                    </div>
                  </div>
              </div>
              <div class="col-3 py-3">
                <div class="input-group">
                <div class="form-outline">
                <div class="d-flex">
                  <input type="search" class="form-control" placeholder="Cause..." name="cause" value={{Request::get('cause')}}>
                  <button class="btn btn-primary ml-3">
                    <i class="fas fa-search"></i>  
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
    <th></th>
<th>Nom Employé</th>
<th>Jour Annuel</th>
<th>Cause</th>
<td>Nombre de Congé</td>
  </tr>
  </thead>
  <tbody>
  @if(count($soldes)>0)
  @foreach($soldes as $solde)
  <tr>
        @if($solde->employe->photo)
                <td><img src ="{{asset('upload/employe/'. $solde->employe->photo)}}" alt="Employe image" class="rounded float-left" width="50px" height="50px"/></td>
                @else
                <td><img src="{{asset('Image/employe1.png')}}" class="rounded float-left" width="50px" height="50px"/></td>
                @endif
          <td>{{$solde->employe->nom}} {{$solde->employe->prenom}}</td>
          <td>{{$solde->jourAnnuel}}</td>
          <td>{{$solde->cause}}</td>
          <td>{{$solde->employe->nombreConge}}</td>       
          <td class ="d-flex ml-5 ">
              <a href="{{route('soldes.show', ['id'  => $solde->id]) }}" class="btn btn-primary btn-sm " style="width:30px;height:30px">
                  <i class="fas fa-eye"></i></a>
                  <a href="{{route('soldes.edit',['id' => $solde->id]) }}" class="btn btn-warning btn-sm ml-2" style="width:30px;height:30px">
                      <i class="fas fa-edit"></i></a>
                  <form action="{{route('soldes.destroy',['id' => $solde->id])}}" method="post" class="form-group">
                      @csrf 
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger ml-2 destroy" style="width:30px;height:30px;padding:5px;" >
                          <i class="fas fa-trash-alt"></i>
                      </button>
                  </form>
          </td>
      </tr>
        @endforeach
      @else     
      <tr>
          <td colspan="4"><strong>Aucun solde demandé</strong></td>
      </tr>
      @endif
  </tbody>
  </table>
  <div class="float-right mt-2">{{$soldes->links()}}</div>
        </div>
        <div class="container">
        <a href="{{route('soldes.pdf')}}" class="btn btn-dark col-md-3 ml-3 mb-3">Extraire la liste en pdf</a>
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
text: "Vous voullez supprimer ce solde ?",
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