<!DOCTYPE html>
<html lang="en">
<head>
    <title>PDF des Utilisateurs</title>
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
            <th>Nom</th>
            <th>Ville</th>
            <th>Adresse</th>
            <th>Numero de telephone</th>
        </tr>
        <tbody>
            @if(count($users)>0)
            @foreach($users as $user)
            <tr>
                <td>{{$user->name}} {{$user->prenom}}</td>
                <td>{{$user->ville}}</td>
                <td>{{$user->adresse}}</td>
                <td>{{$user->numeroTelephone}}</td>
            </tr>
            @endforeach
            @else 
            <div class="alert-alert-info">Aucun utilisateur pour le moment...</div>
            @endif
        </tbody>
    </table>
</body>
</html>