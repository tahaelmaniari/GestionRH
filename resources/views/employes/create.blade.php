@extends('layouts.app')
@section('content')
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Ajouter un employé</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <form action="{{route('employes.store')}}"method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control @if($errors->has('nom')) is-invalid @endif "name="nom" value="{{old('nom')}}"/>
                    @if($errors->has('nom'))
                    <div class="invalid-feedback">{{$errors->first('nom')}}</div>
                    @endif
                    <label for="prenom">Prenom</label>
                    <input type="text" class="form-control @if($errors->has('prenom')) is-invalid @endif "name="prenom" value="{{old('prenom')}}"/>
                    @if($errors->has('prenom'))
                    <div class="invalid-feedback">{{$errors->first('prenom')}}</div>
                    @endif
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif "name="email" value="{{old('email')}}"/>
                      @if($errors->has('email'))
                      <div class="invalid-feedback">{{$errors->first('email')}}</div>
                      @endif
                    </div>
                    <div class="form-group">
                        <label for="Photo">Photo</label>
                    <div class="input-group mb-3 mt-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Choisir un fichier</span>
                        </div>
                        <div class="custom-file py-2">
                            <label for="Fichier" class="custom-file-label">Photo</label>
                          <input type="file" class="custom-file-input @if($errors->has('photo')) is-invalid @endif" name="photo" value="{{old('photo')}}"/>
                          @if($errors->has('photo'))
                          <div class="invalid-feedback">{{$errors->first('photo')}}</div>
                          @endif
                        </div>
                    </div>
                </div>
                <label for="ville">Ville</label>
                <input type="text" class="form-control @if($errors->has('ville')) is-invalid @endif "name="ville" value="{{old('ville')}}"/>
                @if($errors->has('ville'))
                <div class="invalid-feedback">{{$errors->first('ville')}}</div>
                @endif
                <label for="adresse">Adresse</label>
                <input type="text" class="form-control @if($errors->has('adresse')) is-invalid @endif "name="adresse" value="{{old('adresse')}}"/>
                @if($errors->has('adresse'))
                <div class="invalid-feedback">{{$errors->first('adresse')}}</div>
                @endif
                </div>
                </div>
            </div>
                <div class="form-group">
                    <label for="Numero de telephone">Numero de telephone</label>
                    <input type="text" class="form-control @if($errors->has('numeroTelephone')) is-invalid @endif " name="numeroTelephone" value="{{old('numeroTelephone')}}"/>
                    @if($errors->has('numeroTelephone'))
                    <div class="invalid-feedback">{{$errors->first('numeroTelephone')}}</div>
                    @endif
                    <div class="form-group">
                        <label for="Date de debut">Date de début</label>
                        <input type="date" class="form-control @if($errors->has('dateDebut')) is-invalid @endif" name="dateDebut" value="{{old('dateDebut')}}"/>
                        @if($errors->has('dateDebut'))
                        <div class="invalid-feedback">{{$errors->first('dateDebut')}}</div>
                        @endif
                    <div class="form-group">
                    <label for="date de fin">Date de fin</label>
                    <input type="date" class="form-control @if($errors->has('dateFin')) is-invalid @endif" name="dateFin" value="{{old('dateFin')}}"/>
                    @if($errors->has('dateFin'))
                    <div class="invalid-feedback">{{$errors->first('dateFin')}}</div>
                    @endif
                    </div>
                    <label for="Specialite">Specialité</label>
                    <input type="text" class="form-control @if($errors->has('specialite')) is-invalid @endif " name="specialite" value="{{old('specialite')}}"/>
                    @if($errors->has('specialite'))
                    <div class="invalid-feedback">{{$errors->first('specialite')}}</div>
                    @endif
                    <label for="nombreConge">Nombre de Congé</label>
                    <input type="number" class="form-control @if($errors->has('nombreConge')) is-invalid @endif " name="nombreConge" value="{{old('nombreConge')}}"/>
                    @if($errors->has('nombreConge'))
                    <div class="invalid-feedback">{{$errors->first('nombreConge')}}</div>
                    @endif
                    <div class="form-group">
                      <label for="password">Mot de passe</label>
                      <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif "name="password" value="{{old('password')}}"/>
                      @if($errors->has('password'))
                      <div class="invalid-feedback">{{$errors->first('password')}}</div>
                      @endif
                      <div class="form-group @if($errors->has('role')) is-invalid @endif">
                    <label>Role</label>
                    <div class="  @if($errors->has('role')) is-invalid @endif" >
                      <select class="form-control select2
                       @if($errors->has('role')) is-invalid @endif"
                       name="role" id="role">
                        <option value=""
                         class="form-control">
                         Veuillez choisir un role</option>
                        </div>
                        @foreach($users->unique('role') as $user)
                        <option value="{{$user->role}}">
                          {{$user->role}}</option>
                              @endforeach
                      </select>
                        @if($errors->has('role'))
                    <div class="invalid-feedback">{{$errors->first('role')}}</div>
                    @endif
                    </div>
                    <button class="btn btn-primary mt-4">S'enregistrer</button>
                </form>
        </div>
      </div>
    </div>
 
@endsection
@section('js')
<script>//Initialize Select2 Elements
    $('.select2zz').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
</script>
@endsection