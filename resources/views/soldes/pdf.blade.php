<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF des soldes</title>
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
        font-size : 20px;
    }
    td
    {
        margin:10px;
        padding:10px;
        font-size : 18px;
        border-bottom : 1px dashed;
    }
    th{
        text-align: inherit;
            }
</style>
</head>
<body>
    <table>
        <tr>
            <th>Nom Employe</th>
            <th>Nombre de Congé</th>
            <th>Jour Annuel</th>
            <th>Cause</th>
        </tr>
        <tbody>
            @if(count($soldes)>0)
            @foreach($soldes as $solde)
            <tr>
                <td>{{$solde->employe->nom}} {{$solde->employe->prenom}}</td>
                <td>{{$solde->employe->nombreConge}}</td>
                <td>{{$solde->jourAnnuel}}</td>
                <td>{{$solde->cause}}</td>
            </tr>
            @endforeach
            @else 
            <div class="alert-alert-info">Aucun solde pour le moment...</div>
            @endif
        </tbody>
    </table>
</body>
</html>