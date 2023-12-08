<!DOCTYPE html>
<html lang="en">
<head>
    <title>PDF des Employés</title>
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
            <th>Prenom</th>
            <th>Ville</th>
            <th>Adresse</th>
            <th>Numero de telephone</th>
            <th>Specialite</th>
        </tr>
        <tbody>
            @if(count($employes)>0)
            @foreach($employes as $employe)
            <tr>
                <td>{{$employe->nom}}</td>
                <td>{{$employe->prenom}}</td>
                <td>{{$employe->ville}}</td>
                <td>{{$employe->adresse}}</td>
                <td>{{$employe->numeroTelephone}}</td>
                <td>{{$employe->specialite}}</td>
            </tr>
            @endforeach
            @else 
            <div class="alert-alert-info">Aucun employé pour le moment...</div>
            @endif
        </tbody>
    </table>
</body>
</html>