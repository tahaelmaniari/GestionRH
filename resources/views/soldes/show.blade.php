@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
      <h1>Solde de {{$solde->employe->nom}} {{$solde->employe->prenom}}</h1>
      <div class="float-right">
        <a href="{{route('soldes.index')}}" class="btn btn-dark">Revenir</a>
    </div>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
<div class="form-group float-right">
  <a href="{{route('soldes.create')}}" class="bnt btn-success py-2 px-2">Ajouter un solde</a>
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
                    <th>Nombre Congé</th>
                    <th>Jour Annuel</th>
                    <th>Cause</th>
                </thead>
                <tbody>
                    <tr>
                      @if($solde->employe->photo)
                      <td><img src="{{asset('upload/employe/'.$solde->employe->photo)}}" class="rounded float-left" width="50px" height="50px" alt="Image User"></td>
                      @else 
                      <td><img src="{{asset('upload/Image/anonymous.png')}}"class="rounded float-left" width="50px" height="50px" alt="Image User"></td>
                      @endif
                        <td>{{$solde->employe->nom}} {{$solde->employe->prenom}}</td>
                        <td>{{$solde->employe->nombreConge}}</td>
                        <td>{{$solde->jourAnnuel}}</td>
                        <td>{{$solde->cause}}</td>
                        <td>
                            <div class="d-flex">
                            <a href="{{route('soldes.index')}}" class="btn btn-primary btn-sm"style="width:30px;margin-left:20px;height:30px;">
                                <i class="fas fa-undo-alt"></i></a>
                                <a href="{{route('soldes.edit',['id' => $solde->id]) }}" class="btn btn-warning btn-sm" style="width:30px;margin-left:20px;height:30px;">
                                    <i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('soldes.destroy', $solde->id) }}" class="form-group ">
                                    @csrf 
                                    {{ method_field('DELETE') }}
                                    <button type="submit"class="btn btn-danger btn-sm destroy" style="width:30px;margin-left:20px;height:30px;">
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
text: "Vous voullez supprimer ce solde !",
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
/*function annulerConge(event,id)
    {
      event.preventDefault();
      let formParent = document.getElementById('formAnnuler');
Swal.fire({
  title: 'Invalider le congé ?',
  showCancelButton: true,
  confirmButtonText: `Oui`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  /*if (result.isConfirmed) {
    Swal.fire('Congé invalidé !', '', 'success')
    formParent.submit();
  } else if (result.isDenied) {
    Swal.fire('Congé ni valié ni invalidé', '', 'info')
  }
}) 
    }*/
</script>
    
@endsection
