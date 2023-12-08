<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF des congés</title>
<style>
    body{
        background: #e6e6e6;
    }
    table{
        width:100%;
        border:3px solid #e6e6e6;
    }
    thead
    {
        background: blue;
        padding: 10px;
    }
    tr
    {
        margin:10px;
        padding:10px;
        font-size : 20px;
    }
    td
    {
        margin:10px;
        padding:10px;
        font-size : 18px;
    }
</style>
</head>
<body>
    <table>
        <tr>
            <th>Photo Employe</th>
            <th>Nom Employe</th>
            <th>typeConge</th>
            <th>Date de Debut</th>
            <th>Date de fin</th>
        </tr>
        <tbody>
            @if(count($conges)>0)
            @foreach($conges as $conge)
            <tr>
                @if($conge->employe->photo)
                <td><img src="{{asset('upload/employe/'.$conge->employe->photo)}}" alt="Employee Image" width="50px"height="50px" class="circle-rounded"></td>
                @else 
                <td><img src="{{asset('upload/employe/employe1.png')}}" alt="Employee Image" width="50px"height="50px" class="circle-rounded"></td>
                @endif
                <td>{{$conge->employe->nom}} {{$conge->employe->prenom}}</td>
                <td>{{$conge->typeConge->nom}}</td>
                <td>{{$conge->dateDebut}}</td>
                <td>{{$conge->dateFin}}</td>
            </tr>
            @endforeach
            @else 
            <div class="alert-alert-info">Aucun congé pour le moment...</div>
            @endif
        </tbody>
    </table>
</body>
</html>