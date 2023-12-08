<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Conge;
use App\Models\Contrat;
use App\Models\Employe;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use PDF;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth')->except('users.index');
    }
    public function connect()
    {
        $password = Hash::make('TAHAyassine01');
        dd($password);
    }
    public function index(Request $request)
    {
        if(auth()->user()->role == 'admin')
        {
            $users = User::when($request->nom,function($query,$nom){         
                return $query->where('name','like','%'.$nom.'%');
                 })->when($request->prenom,function($query,$prenom){
                     return $query->where('prenom','like','%'.$prenom.'%');
                 })->when($request->email,function($query,$email){
                     return $query->where('email','like','%'.$email.'%');
                 })->when($request->ville,function($query,$ville){
                     return $query->where('ville','like','%'.$ville.'%');
                 })->orderBy('id','desc')->paginate(5);
             return View('users.index',['users' => $users]);
        }
        $users = User::when($request->nom,function($query,$nom){         
       return $query->where('name','like','%'.$nom.'%');
        })->when($request->prenom,function($query,$prenom){
            return $query->where('prenom','like','%'.$prenom.'%');
        })->when($request->email,function($query,$email){
            return $query->where('email','like','%'.$email.'%');
        })->when($request->ville,function($query,$ville){
            return $query->where('ville','like','%'.$ville.'%');
        })->orderBy('id','desc')->where('id',auth()->user()->id)->paginate(5);
    return View('users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return View('users.create',['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $request->validate([
            'nom' => 'required|min:3|max:30',
            'prenom' => 'required|min:3|max:30',
            'email' => 'required |min:5|max:50|unique:users',
            'ville' => 'required| min:2|max:30',
            'password' => 'required|confirmed',
            'role' => 'required',
            ]);
            $user = new User();
            $user->name = $request->nom;
            $user->prenom = $request->prenom;
            $user->email = $request->email;
            $user->ville = $request->ville;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            if($request->has('photo'))
            {
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time().''.$extension;
                $file->move('upload/employe/',$filename);
                $user->photo = $filename;
            }
            else
            {
                $user->photo = "";
            }
            // $user->confirmPassword = $request->input['confirmPassword'];
            $user->save();
            Session::flash('success','Vous avez enregistré avec succées');
            return redirect()->route('users.index');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        // dd($user);
        return View('users.show',['user'=> $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit',['user' => $user]);
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
        $request->validate([
            'nom' => 'required|min:3|max:30',
            'prenom' => 'required|min:3|max:30',
            'email' => 'required |min:5|max:50',
            'ville' => 'required| min:5|max:20',
            ]);
        $user = User::find($id);
        $employe = Employe::find($id);
        $user->name = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->ville = $request->ville;
        $employe->nom = $request->nom;
        $employe->prenom = $request->prenom;
        $employe->ville = $request->ville;
        $employe->password = Hash::make($request->password);
        if($request->password !== null)
        {
        $user->password = Hash::make($request->password);
        }
        else 
        {
            $request->password = $user->password;
        }
        if($request->has('photo'))
        {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().''.$extension;
            $file->move('upload/employe/',$filename);
            $user->photo = $filename; 
            $employe->photo = $filename;   
        }
        $user->update();
        $employe->update();
        $request->session()->flash('updatedUser', 'Les informations ont bien été modifiés');
        return redirect()->route('users.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $employe = $user->employe();
        $user->delete();
        $employe->delete();
        return redirect()->route('users.index',compact('user'));
    }
public function pdf()
{
    $users= Employe::all();
    $data = [
        'users' => $users,
    ];
    $pdf = PDF::loadView('users.pdf', $data);
    return $pdf->download('users.pdf');
    /*$users = User::all();
    return view('users.pdf',['users' => $users]);*/
}
public function informations()
{
    $nombreConges = 0;
    $nbCongeDemandeEmploye =0;
    $user = auth()->user();
    $users = User::all();
    $employe = Employe::where('user_id',$user->id)->first();
    $employes = Employe::all()->count();
    $contrat = Contrat::where('employe_id',$user->id)->first();
    //$nombreCongeDemande = Conge::where('user_id',$user->id)->get('nombreCongeDemande')->first();
    $nombreCongeDemande = DB::table('conges')->where('user_id', $user->id)->select('nombreCongeDemande')->pluck('nombreCongeDemande');
    $nombreConge = DB::table('employes')->where('user_id',$user->id)->select('nombreConge')->pluck('nombreConge')->first();
    $nombreCongeDemandeEmploye = DB::table('conges')->where('user_id',$user->id)->select('nombreCongeDemandeEmploye')->pluck('nombreCongeDemandeEmploye');
    foreach($nombreCongeDemandeEmploye as $nbCongeDemande)
    {
    $nbCongeDemandeEmploye += $nbCongeDemande;
    }
    foreach($nombreCongeDemande as $nbConges)
    {
        $nombreConges += $nbConges;
    }
    $jourAnnuel = 0;
    $dateDebut = DB::table('conges')->where('user_id',$user->id)->select('dateDebut')->pluck('dateDebut')->first();
    $typeStatus = "Null";
    $status = DB::table('conges')->where('user_id',$user->id)->select('status')->pluck('status');
    $contrats = DB::table('contrats')->where('user_id', $user->id)->select('typeContrat')->pluck('typeContrat')->first();
    $specialite = DB::table('employes')->where('user_id',$user->id)->select('specialite')->pluck('specialite')->first();
    $jourAnnuels = DB::table('soldes')->where('user_id',$user->id)->select('jourAnnuel')->pluck('jourAnnuel');
    foreach($jourAnnuels as $j)
    {
        $jourAnnuel +=$j;
    }
    foreach($status as $s)
    {
        if($s == 0)
        {
        $typeStatus = 'Non Confirmé';
        }
        else
        {
        $typeStatus = 'Confirmé';
        }
    }
     // $users = User::all()->count();
    //$employes = Employe::all()->count();
    //$conge = $user->conge->count();
    //$contrat = $user->contrat->count();
    return view('users.informations',['users' => $users,'nbCongeDemandeEmploye'=>$nbCongeDemandeEmploye,'jourAnnuel' => $jourAnnuel,'employe' => $employe,'employes' => $employes,'contrat' => $contrat,'user' => $user,'nombreCongeDemande'=> $nombreCongeDemande,'contrats' => $contrats,'nombreConges' => $nombreConges,'specialite'=> $specialite,'nombreConge'=> $nombreConge,'typeStatus' => $typeStatus,'dateDebut' => $dateDebut]);
}
}
