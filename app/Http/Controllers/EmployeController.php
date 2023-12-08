<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\User;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Session\Session;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->role == 'admin')
        {
            $employes = Employe::when($request->nom,function($query,$nom)
            {
                return $query->where('nom','like','%'.$nom .'%');
            })->when($request->prenom,function($query,$prenom)
            {
                return $query->where('prenom','like','%'.$prenom .'%');
            })->when($request->ville,function($query,$ville)
            {
                return $query->where('ville','like','%'.$ville .'%');
            })->when($request->adresse,function($query,$adresse)
            {
                return $query->where('adresse','like','%'.$adresse .'%');
            })->when($request->numeroTelephone,function($query,$numeroTelephone)
            {
                return $query->where('numeroTelephone','like','%'.$numeroTelephone .'%');
            })->when($request->dateDebut,function($query,$dateDebut)
            {
                return $query->where('dateDebut', '=',$dateDebut);
            })->when($request->dateFin,function($query,$dateFin)
            {
                return $query->where('dateFin','=',$dateFin);
            })->when($request->specialite,function($query,$specialite)
            {
                return $query->where('specialite','like','%'.$specialite .'%');
            })->paginate(5);
         return View('employes.index',['employes'=> $employes]);
        }
        $employes = Employe::when($request->nom,function($query,$nom)
        {
            return $query->where('nom','like','%'.$nom .'%');
        })->when($request->prenom,function($query,$prenom)
        {
            return $query->where('prenom','like','%'.$prenom .'%');
        })->when($request->ville,function($query,$ville)
        {
            return $query->where('ville','like','%'.$ville .'%');
        })->when($request->adresse,function($query,$adresse)
        {
            return $query->where('adresse','like','%'.$adresse .'%');
        })->when($request->numeroTelephone,function($query,$numeroTelephone)
        {
            return $query->where('numeroTelephone','like','%'.$numeroTelephone .'%');
        })->when($request->dateDebut,function($query,$dateDebut)
        {
            return $query->where('dateDebut', '=',$dateDebut);
        })->when($request->dateFin,function($query,$dateFin)
        {
            return $query->where('dateFin','=',$dateFin);
        })->when($request->specialite,function($query,$specialite)
        {
            return $query->where('specialite','like','%'.$specialite .'%');
        })->where('user_id',auth()->user()->id)->paginate(5);
     return View('employes.index',['employes'=> $employes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Employe::all();
        return view('employes.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenom' => 'required',
            'ville' => 'required',
            'adresse' => 'required',
            'numeroTelephone' => 'required|numeric|min:10',
            'dateDebut' => 'required|date_format:Y-m-d',
           'specialite' => 'required',
           'nombreConge' => 'required|not_in:0',
           'password' => 'required|min:4|max:60',
           'email' => 'required|unique:users',
           'role' => 'required',
           'dateFin' => 'required|date_format:Y-m-d'
           ]);
       if ($validator->fails()) {
        return redirect(url()->previous())
        ->withErrors($validator)
        ->withInput();
       }
       $usersCount = User::all()->count();
            $user = new User();
            $employe = new Employe();
            $user->name = $request->nom;
            $user->prenom = $request->prenom;
            $user->email = $request->email;
            $user->ville = $request->ville;
            $user->adresse = $request->adresse;
            $user->numeroTelephone = $request->numeroTelephone;
            $user->password = Hash::make($request->password);
            $user->nombreConge = 50;
            $employe->nom = $request->nom;
            $employe->prenom = $request->prenom;
            $employe->ville = $request->ville;
            $employe->adresse = $request->adresse;
            $employe->numeroTelephone = $request->numeroTelephone;
            $employe->dateDebut = $request->dateDebut;
            $employe->dateFin = $request->dateFin;
            $employe->specialite = $request->specialite;
            $employe->password = Hash::make($request->password);
            $employe->nombreConge = $request->nombreConge;
            $employe->nombreCongeDemandeByEmploye = 0;
            $employe->nombreVacance = 0;
            $employe->role = $request->role;
            $maxId = DB::table('users')->max('id');
            $user->role = $request->role;
            $employe->role = $request->role;
            if($request->has('photo'))
            {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time().''.$extension;
                $file->move('upload/employe/',$filename);
                $employe->photo = $filename;
                $user->photo = $filename;
            }
            else
            {
                $employe->photo = "";
            }
            $user->save();
            $employe->id = $user->id;
            $employe->user_id = $user->id;
            $employe->save();
            $request->session()->flash('success', 'Vous etes enregistré avec succées');
            return redirect()->route('employes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employe = Employe::find($id);
        return View('employes.show',['employe' => $employe]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employe = Employe::find($id);
        $users = User::all();
        return view('employes.edit',['employe' => $employe,'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
      {
        $validator = Validator::make($request->all(), [

            'nom' => 'required',
            'prenom' => 'required',
            'ville' => 'required',
            'adresse' => 'required',
            'numeroTelephone' => 'required',
            'dateDebut' => 'required|date_format:Y-m-d',
           'specialite' => 'required',
           ]);
       if ($validator->fails()) {
        return redirect(url()->previous())
        ->withErrors($validator)
        ->withInput();
       }
            $employe = Employe::find($id);
            $user = $employe->user;
            $user->name = $request->nom;
            $user->prenom = $request->prenom;
            $user->ville = $request->ville;
            $user->adresse = $request->adresse;
            $user->numeroTelephone = $request->numeroTelephone;
            $employe->nom = $request->nom;
            $employe->prenom = $request->prenom;
            $employe->ville = $request->ville;
            $employe->adresse = $request->adresse;
            $employe->numeroTelephone = $request->numeroTelephone;
            $employe->dateDebut = $request->dateDebut;
            $employe->dateFin = $request->dateFin;
            $employe->password = Hash::make($request->password);
            $user->password = $employe->password;
            $employe->specialite = $request->specialite;
            if($request->has('photo'))
            {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time().''.$extension;
                $file->move('upload/employe/',$filename);
                $employe->photo = $filename;
                $user->photo = $filename;
            }
            else
            {
                $user->photo=$employe->photo;
            }
            $employe->save();
            $user->save();
            $request->session()->flash('good', 'Vous avez modifié avec succées');
            return redirect()->route('employes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $employe = Employe::find($id);
        $user = $employe->user;
        $user->delete();
        $employe->delete();
        $request->session()->flash('employeDeleted', "L'employé " .$employe->nom .' '.$employe->prenom ." "."supprimé avec succés");
        return redirect()->route('employes.index');
    }
    public function pdf()
    {
        $employes = Employe::all();
        $data = [
            'employes' => $employes
        ];
        $pdf = PDF::loadView('employes.pdf',$data);
        return $pdf->download('employes.pdf');
    }
    
}
