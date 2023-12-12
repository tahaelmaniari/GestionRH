@extends('layouts.app')
@section('content')
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Demander une absence</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <form action="{{route('absences.store')}}"method="post">
                @csrf
                <div class="form-group">
                    <label for="nom">Motif</label>
                    <input type="text" class="form-control @if($errors->has('motif')) is-invalid @endif "name="motif" value="{{old('motif')}}"/>
                    @if($errors->has('motif'))
                    <div class="invalid-feedback">{{$errors->first('motif')}}</div>
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
                    <button class="btn btn-primary mt-4">Demander</button>
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