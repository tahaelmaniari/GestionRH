@extends('layouts.app')
@section('content')
    <div class="card card-default">
      <div class="card-header">
        <h1>La liste des utilisateurs</h1>
        @if(Session::has('good'))
<div class="alert-alert-info">{{Session::get('good')}}</div>
@endif
@if(Session::has('success'))
<p class="alert alert-info">{{ Session::get('success') }}</p>
@endif
@if(Session::has('updatedUser'))
<p class="alert alert-success">{{ Session::get('updatedUser') }}</p>
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
                     <input type="search" class="form-control" placeholder="Email..." name="email" value={{Request::get('email')}}>
                      </div>
                        </div>
                      </div>
                  </div>
                  <div class="col-3 py-3">
                              <div class="input-group">
                              <div class="form-outline">
                                  <div class="d-flex">
                                <input type="search" class="form-control" placeholder="Ville..." name="ville" value={{Request::get('ville')}} >
                              <button class="btn btn-primary">
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
<th>Email</th>
<th>Ville</th>
<th class="text-center">Actions</th>
  </tr>
  </thead>
  <tbody>
  @if(count($users)>0)
  @if(auth()->user()->role == 'admin')
  @foreach($users as $user)
      <tr>
          @if($user->photo)
          <td><img src ="{{asset('upload/employe/'. $user->photo)}}" alt="User image" class="rounded float-left" width="50px" height="50px"/></td>
          @else
          <td><img src="{{asset('upload/employe/anonymous.png')}}" class="rounded float-left" width="50px" height="50px"/></td>
          @endif
          <td>{{$user->name}} {{$user->prenom}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->ville}}</td>
          <td class ="d-flex ml-5 ">
              <a href="{{route('users.show', ['id'  => $user->id]) }}" class="btn btn-primary btn-sm " style="width:30px;height:30px">
                  <i class="fas fa-eye"></i></a>
                  <a href="{{route('users.edit',['id' => $user->id]) }}" class="btn btn-warning btn-sm ml-2" style="width:30px;height:30px">
                      <i class="fas fa-edit"></i></a>
                  <form action="{{route('users.destroy',['id' => $user->id])}}" method="post" class="form-group">
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
        @if(auth()->user()->photo)
        <td><img src ="{{asset('upload/image/'. $user->photo)}}" alt="User image" class="rounded float-left" width="50px" height="50px"/></td>
        @else
        <td><img src="{{asset('upload/image/anonymous.png')}}" class="rounded float-left" width="50px" height="50px"/></td>
        @endif
        <td>{{auth()->user()->name}} {{auth()->user()->prenom}}</td>
        <td>{{auth()->user()->email}}</td>
        <td>{{auth()->user()->ville}}</td>
        </td>
    </tr>
      @endif   
      @else
      <tr>
          <td colspan="4"><strong>Aucun utilisateur trouvé</strong></td>
      </tr>
      @endif
  </tbody>
  </table>
  <div class="float-right mt-2">{{$users->links()}}</div>
        </div>
        <div class="container">
          <a href="{{route('users.pdf')}}" class="btn btn-dark">Extraire la liste en pdf</a>
        </div>
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