<?php

namespace App\Http\Controllers;
use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Conge;
use App\Models\Solde;
use App\Models\Contrat;
use App\Models\Employe;
use App\Models\TypeConge;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Validator;

class CongeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = DB::table('employes')->select('id')->pluck('id');
        if(auth()->user()->role == 'admin')
        {
            $conges = Conge::when($request->employe_id,function($query,$employe_id)
            {
             return $query->where('employe_id','like','%'.$employe_id .'%');
            })->when($request->typeConge_id,function($query,$typeConge_id)
            {
                return $query->where('typeConge_id','like','%'.$typeConge_id.'%');
            })->when($request->dateDebut,function($query,$dateDebut)
            {
                return $query->where('dateDebut','=',$dateDebut);
            })->when($request->dateFin,function($query,$dateFin)
            {
                return $query->where('dateFin','=',$dateFin);
            })->orderBy('id','desc')->paginate(5);
            return view('conges.index',['conges' => $conges]);
        }
        else
        {
        $conges = Conge::when($request->employe_id,function($query,$employe_id)
        {
         return $query->where('employe_id','like','%'.$employe_id .'%');
        })->when($request->typeConge_id,function($query,$typeConge_id)
        {
        return $query->where('typeConge_id','like','%'.$typeConge_id.'%');
        })->when($request->dateDebut,function($query,$dateDebut)
        {
        return $query->where('dateDebut','=',$dateDebut);
        })->when($request->dateFin,function($query,$dateFin)
        {
            return $query->where('dateFin','=',$dateFin);
        })->where('user_id',auth()->user()->id)->paginate(5);
        return view('conges.index',['conges' => $conges]);
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conges = Conge::all();
        $employes = Employe::all();
        $typeConges = TypeConge::all();
        return view('conges.create',['conges'=>$conges,'employes'=>$employes,'typeConges' => $typeConges]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->role == 'user')
        {
        $validator = Validator::make($request->all(), [
            'typeConge_id' => 'required',
            'dateDebut' => 'required|date_format:Y-m-d|after:yesterday',
           'dateFin' => 'required|date_format:Y-m-d|after:dateDebut',
           'nombreCongeDemandeEmploye' => 'required|not_in:0',
           ]);
          if ($validator->fails()) {
            return redirect(url()->previous())
           ->withErrors($validator)
            ->withInput();
              }
              $emp = Employe::findOrFail(auth()->user()->id);
              $conge = $emp->conge;
              /*$dateDebut = Carbon::parse($request->dateDebut);
              $dateFin = Carbon::parse($request->dateFin);
              $nombreCongeDemande = $dateFin->diffInDays($dateDebut);
              $totalDays += $nombreCongeDemande;*/
              $totalDays = 0;
              $nbConge = DB::table('conges')->select('nombreCongeDemande')->where('employe_id',$emp->id)->sum('nombreCongeDemande');
             if($emp->nombreConge >= $totalDays)
             {
                $c = new Conge();
                $c->employe_id = $emp->id;
                $c->typeConge_id = $request->typeConge_id;
                $c->dateDebut = $request->dateDebut;
                $c->dateFin = $request->dateFin;
                $c->nombreCongeDemandeEmploye = $request->nombreCongeDemandeEmploye;
                $c->nombreCongeDemandeByEmploye = $request->nombreCongeDemandeEmploye;
                //$c->nombreCongeDemande = $totalDays;
                //$emp->nombreConge = $emp->nombreConge - $totalDays;
                $c->user_id = auth()->user()->id;
                $c->admin_id = 0;
                $c->dateAccorde = Carbon::now();
                $c->save();
                $emp->save();
                $request->session()->flash('success','Vous aves bien bien demandé le congé');
                return redirect()->route('conges.index');
             }
             else
             {
                $request->session()->flash('info','Impossible de prendre le congé');
                return redirect()->route('conges.index');
             }
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'employe_id' => 'required',
                    'typeConge_id' => 'required',
                    'dateDebut' => 'required|date_format:Y-m-d|after:yesterday',
                   'dateFin' => 'required|date_format:Y-m-d|after:dateDebut',
                   'nombreCongeDemandeEmploye' => 'required|not_in:0'
                   ]);
                  if ($validator->fails()) {
                    return redirect(url()->previous())
                   ->withErrors($validator)
                    ->withInput();
                      }
                      $emp = Employe::findOrFail($request->employe_id);
                      $conge = $emp->conge;
                      //$totalDays = $emp->takenDays();
                      //$dateDebut = Carbon::parse($request->dateDebut);
                      //$dateFin = Carbon::parse($request->dateFin);
                      //$nombreCongeDemande = $dateFin->diffInDays($dateDebut);
                      //$totalDays += $nombreCongeDemande;
                      $totalDays = 0;
                      $nbConge = DB::table('conges')->where('employe_id',$emp->id)->sum('nombreCongeDemande');
                        $c = new Conge();
                        $c->employe_id = $request->employe_id;
                        $c->typeConge_id = $request->typeConge_id;
                        $c->dateDebut = $request->dateDebut;
                        $c->dateFin = $request->dateFin;
                        $c->nombreCongeDemandeEmploye = $request->nombreCongeDemandeEmploye;
                        $c->nombreCongeDemande = $request->nombreCongeDemandeEmploye;
                        $c->nombreCongeDemandeByEmploye = $request->nombreCongeDemandeEmploye;
                        $c->admin_id = auth()->user()->id;
                        if($emp->nombreConge)
                        {
                        $emp->nombreConge = $emp->nombreConge;
                        }
                        $c->user_id = $emp->id;
                        $c->save();
                        $emp->save();
                        $request->session()->flash('success','Vous a bien demandé le congé');
                        return redirect()->route('conges.index');
            }
        }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conge = Conge::find($id);

        return view('conges.show',['conge' => $conge]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conge = Conge::find($id);
        $typeConge = $conge->typeConge;
        $typeConges = TypeConge::all();
        $employe = $conge->employe;   
        return view('conges.edit',['conge' => $conge,'typeConges' => $typeConges,'typeConge' => $typeConge,'employe' => $employe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if(auth()->user()->role == 'user')
        {
        $validator = Validator::make($request->all(), [
             'typeConge_id' => 'required',
             'dateDebut' => 'required|date_format:Y-m-d',
             'dateFin' => 'required|date_format:Y-m-d|after:dateDebut',
           ]);
          if ($validator->fails()) {
            return redirect(url()->previous())
           ->withErrors($validator)
            ->withInput();
              }
              $conge = Conge::findOrFail($id);
              $emp = $conge->employe;
              //$totalDays = $emp->takenDays($conge->employe->id);
              $dateDebut = Carbon::parse($request->dateDebut);
              $dateFin = Carbon::parse($request->dateFin);
              $nombreCongeDemande = $dateFin->diffInDays($dateDebut);
              $nombreCongeDemandeEmploye = $request->nombreCongeDemandeEmploye;
               $nbConge = $request->nombreCongeDemandeEmploye;
                $conge->typeConge_id = $request->typeConge_id;
                $conge->dateDebut = $request->dateDebut;
                $conge->dateFin = $request->dateFin;
                $conge->nombreCongeDemandeEmploye = $request->nombreCongeDemandeEmploye;
                if($conge->status == 1)
                {
                    $emp->nombreConge = $emp->nombreConge - $nombreCongeDemandeEmploye;
                }
                $conge->nombreCongeDemande = $request->nombreCongeDemandeEmploye;
                $conge->nombreCongeDemandeByEmploye = $request->nombreCongeDemandeEmploye;
                $conge->update();
                $emp->update();
                $request->session()->flash('success','Vous a bien modifié votre congé');
                return redirect()->route('conges.index');
            }
            else
            {
                $validator = Validator::make($request->all(), [
                    'typeConge_id' => 'required',
                    'dateDebut' => 'required|date_format:Y-m-d',
                    'dateFin' => 'required|date_format:Y-m-d|after:dateDebut',
                  ]);
                 if ($validator->fails()) {
                   return redirect(url()->previous())
                  ->withErrors($validator)
                   ->withInput();
                     }
                     $conge = Conge::findOrFail($id);
                     $emp = $conge->employe;
                     //$totalDays = $emp->takenDays($conge->employe->id);
                       $dateDebut = Carbon::parse($request->dateDebut);
                       $dateFin = Carbon::parse($request->dateFin);
                       $nombreCongeDemande = $dateFin->diffInDays($dateDebut);
                       $nombreCongeDemandeEmploye = $request->nombreCongeDemandeEmploye;
                       $nbConge = $request->nombreCongeDemandeEmploye;
                       $conge->typeConge_id = $request->typeConge_id;
                       $conge->dateDebut = $request->dateDebut;
                       $conge->dateFin = $request->dateFin;
                       $conge->nombreCongeDemandeEmploye = $request->nombreCongeDemandeEmploye;
                       $conge->nombreCongeDemandeByEmploye = $request->nombreCongeDemandeEmploye;
                       if($conge->status == 1)
                       $emp->nombreConge = 50 - $nombreCongeDemandeEmploye;
                       $conge->admin_id = auth()->user()->id;
                       $conge->nombreCongeDemande = $request->nombreCongeDemandeEmploye;
                       $conge->update();
                       $emp->update();
                       $request->session()->flash('success','Vous a bien modifié votre congé');
                       return redirect()->route('conges.index');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        if(auth()->user()->role == 'user')
        {
        $conge = Conge::find($id);
        $employe = $conge->employe;
        $employe->nombreConge +=$conge->nombreCongeDemandeEmploye;
        $conge->delete();
        $employe->save();
        $request->session()->flash('deletedConge', 'Congé bien Supprimé');
        return redirect()->route('conges.index');
        }
        else{
            $conge = Conge::find($id);
            $employe = $conge->employe;
            $employe->nombreConge +=$conge->nombreCongeDemandeEmploye;
            $conge->delete();
            $employe->save();
            $request->session()->flash('deletedConge', "Congé bien Supprimé par l'adminitstrateur");
            return redirect()->route('conges.index');
        }
    }
    public function validation($id,Request $request)
    {
        $conge = Conge::find($id);
        $conge->admin_id = auth()->user()->id;
        $employe = $conge->employe;
        $conge->status = 1;
        $conge->cause = "";
        $dateDebut = Carbon::parse($conge->dateDebut);
        $dateFin = Carbon::parse($conge->dateFin);
        //$nombreCongeDemande = $dateFin->diffInDays($dateDebut);
        $nombreCongeDemandeEmploye = $conge->nombreCongeDemandeByEmploye;
        if($employe->nombreConge >= $conge->nombreCongeDemandeEmploye)
        {
        $employe->nombreConge -= $nombreCongeDemandeEmploye;
        //$conge->nombreCongeDemande -= $nombreCongeDemande;  
        //$conge->nombreCongeDemande -= $nombreCongeDemande;
        $conge->dateAccorde = Carbon::now();
        $conge->nombreCongeDemandeEmploye = $conge->nombreCongeDemandeByEmploye;
        $conge->nombreCongeDemande = $conge->nombreCongeDemandeByEmploye;
        $conge->update();
        $employe->update();
        $request->session()->flash('congeValidation','Le congé est bien validé');
        return redirect()->route('conges.index');
        }
        else
        {
        $request->session()->flash('impossibleValider','Impossible de valider ce congé');
        return redirect()->route('conges.index');
        }
    }
    public function annuler($id)
    {
    $conge = Conge::findOrFail($id);
    $conge->admin_id = auth()->user()->id;
    $conge->status = 2;
    $conge->save();
    return view('conges.annulerConge',['conge' => $conge]);
    }
    public function annulerConge($id,Request $request)
    {
        $conge = Conge::findOrFail($id);
        $employe = $conge->employe;
        $validator = Validator::make($request->all(), [
            'cause' => 'required',
          ]);
         if ($validator->fails()) {
           return redirect(url()->previous())
          ->withErrors($validator)
           ->withInput();
             }
             $cause = $request->cause;
             $conge->cause = $request->cause;
             $conge->status = 2;
             $conge->dateAccorde = Carbon::now();
             //$employe->nombreConge += $conge->nombreCongeDemandeByEmploye;
             $conge->nombreCongeDemandeEmploye = 0;
             $conge->nombreCongeDemande = 0;
             $conge->save();
             $employe->save();
             $request->session()->flash('messageEnvoye','Le message a bien été envoyé à ' .$employe->nom .' '.$employe->prenom);
             return redirect()->route('conges.index');
    }
    public function congeAnnuler($id,Request $request)
    {
        $conge = Conge::find($id);
        if($conge->cause !== null)
        {
            $cause = $conge->cause;
            return view('conges.causeAnnuler',['cause' => $cause,'conge' => $conge]);
        }
    }
    public function redemanderConge($id,Request $request)
    {
        $conge = Conge::findOrFail($id);
        if($conge->tentative <3)
        {
        $conge->dateAccorde = "";
        $conge->nombreCongeDemandeEmploye = $conge->nombreCongeDemandeEmploye;
        $conge->typeConge_id = $conge->typeConge_id;
        $conge->employe_id = $conge->employe_id;
        $conge->dateDebut = $conge->dateDebut;
        $conge->dateFin = $conge->dateFin;
        $conge->user_id = auth()->user()->id;
        $conge->status = 0;
        $conge->tentative++;
        $conge->cause = "";
        $conge->dateAccorde = null;
        $conge->save();
        $request->session()->flash('redemanderConge','Vous avez redemandé le congé au Chef !');
        return redirect()->route('conges.index');
        }
        else
        {
            $request->session()->flash('tentative','Vous avez depassé le nombre de tentative pour redemander le congé');
            return redirect()->route('conges.index');
        }
    }
}