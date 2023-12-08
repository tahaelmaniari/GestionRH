<!DOCTYPE html>
<html lang="en">
<head>
<title>Congé de {{$conges->employe->nom}} {{$conges->employe->prenom}}</title>
</head>
<body>
    <div class="container">
         <img src="omiaData2.png"  style="width :800px;height:800px;position:absolute;left:-50px;"/> 
    </div>
    <div style="position: absolute;left: 196px;
    top: 206px;
    font-size: 16px;">
     {{$conges->employe->nom}}
    </div>
    <div style="
    position: absolute;
    left: 196px;
    top: 227px;
    font-size: 16px;
">
{{$conges->employe->prenom}}
    </div>
    <div style="position:absolute;
    left: 196px;
    top: 249px;
    font-size: 16px;"
>
{{$conges->employe->specialite}}
    </div>
    <div style="    position: absolute;
    left: 196px;
    top: 282px;
    font-size: 16px;"
>
{{$conges->nombreCongeDemandeEmploye}}
    </div>
    <div style="    position: absolute;
    left: 121px;
    top: 301px;
    font-size: 16px;"
>
{{$conges->dateDebut}}
    </div>
    <div style="    position: absolute;
    left: 306px;
    top: 300px;
    font-size: 16px;"
>
{{$conges->dateFin}}
    </div>
    @if($conges->typeConge->nom == "Congé Payé")
    <div style="
    position: absolute;
    left: 89px;
    top: 354px;
    font-size: 16px;
    ">
    <input type="checkbox" name="" id="" checked="true">
    </div>
    @endif
    @if($conges->typeConge->nom == "Examen")
    <div style="
    position: absolute;
    left: 91px;
    top: 366px;
    font-size: 16px;
    ">
    <input type="checkbox" name="" id="" checked="true">
    </div>
    @endif
    @if($conges->typeConge->nom == "Congé de Maladie")
    <div style="
    position: absolute;
    left: 91px;
    top: 380px;
    font-size: 16px;
    ">
    <input type="checkbox" name="" id="" checked>
    @endif
   </div>
    @if($conges->typeconge->nom == "Congé Maternalité/Paternalité")
    <div style="
     position: absolute;
    left: 91px;
    top: 393px;
    font-size: 16px;
    ">
    <input type="checkbox" name="" id="" checked ="true">
    </div>
    @endif
    @if($conges->typeconge->nom == "Autre")
    <div style="
    position: absolute;
   left: 91px;
   top: 406px;
   font-size: 16px;
   ">
   <input type="checkbox" checked ="true">
   </div>
   @endif
    <div style="
    position: absolute;
    left: 280px;
    top: 526px;
    font-size: 16px;
   ">
    {{$conges->dateDebut}} 
   </div>
    <div style="
    position: absolute;
    left: 239px;
    top: 558px;
    font-size: 16px;
    ">
    </div>
    <div style="
    position: absolute;
    left: 161px;
    top: 644px;
    font-size: 16px;
    ">
    @if($conges->status == 1)
     {{$conges->dateAccorde}}
     @endif
    </div>
    <div style="
     position: absolute;
    left: 384px;
    top: 644px;
    font-size: 16px;
    ">
    @if($conges->status == 2)
    {{$conges->dateAccorde}}
     @endif
    </div>
    @if($conges->status)
    <div style="
    position: absolute;
    left: 249px;
    top: 677px;
    font-size: 16px;
   ">
   </div>
   @endif
</body>
</html>