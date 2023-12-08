<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF des contrats</title>
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
<th>ID Contrat</th>
<th>Type Contrat</th>
<th>Date de contrat</th>
<th>Employe Nom</th>
        </tr>
        <tbody>
            @if(count($contrats)>0)
            @foreach($contrats as $contrat)
            <tr>
                <td>{{$contrat->id}}</td>
                <td>{{$contrat->typeContrat}}</td>
                <td>{{$contrat->dateContrat}}</td>
                <td>{{$contrat->employe->nom}} {{$contrat->employe->prenom}}</td>
            </tr>
            @endforeach
            @else 
            <div class="alert-alert-info">Aucun contrat pour le moment...</div>
            @endif
        </tbody>
    </table>
</body>
</html>