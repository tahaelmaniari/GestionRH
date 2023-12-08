<?php

namespace App\Http\Controllers;

use PDF;
use index;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Conge;
use App\Models\Solde;
use App\Models\Employe;
use App\Models\TypeConge;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Session\Session;

class SoldeController extends Controller
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
            $soldes = Solde::when($request->employe_id,function($query,$employe_id)
            {
             return $query->where('employe_id','like','%'.$employe_id .'%');
            })->when($request->jourAnnuel,function($query,$jourAnnuel)
            {
                return $query->where('jourAnnuel','like','%'.$jourAnnuel.'%');
            })->when($request->cause,function($query,$cause)
            {
                return $query->where('cause','like','%'.$cause .'%');
            })->orderBy('id','desc')->paginate(5);
            return view('soldes.index',['soldes' => $soldes]);
        }
        else
        {
            $soldes = Solde::when($request->employe_id,function($query,$employe_id)
            {
             return $query->where('employe_id','like','%'.$employe_id .'%');
            })->when($request->jourAnnuel,function($query,$jourAnnuel)
            {
                return $query->where('jourAnnuel','like','%'.$jourAnnuel.'%');
            })->when($request->cause,function($query,$cause)
            {
                return $query->where('cause','like','%'.$cause .'%');
            })->orderBy('id','desc')->where('user_id',auth()->user()->id)->paginate(5);
            return view('soldes.index',['soldes' => $soldes]);
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employes = Employe::all();
        $conges = Conge::all();
        return view('soldes.create',['employes'=>$employes,'conges' => $conges]);
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
            'employe_id' => 'required',
            'jourAnnuel' => 'required|min:0|not_in:0',
           'cause' => 'required|min:3|max:100',
           ]);
          if ($validator->fails()) {
            return redirect(url()->previous())
           ->withErrors($validator)
            ->withInput();
        }
         $employe = Employe::where('id',$request->employe_id)->first();
         $s = new Solde(); 
         $s->employe_id = $employe->id;
         $s->user_id = auth()->user()->id;
         $s->jourAnnuel = $request->jourAnnuel;
         $s->cause = $request->cause;
         if($employe->nombreConge > 0)
         {
             $employe->nombreConge += $s->jourAnnuel;
         }
         $employe->save();
         $s->save();
         $request->session()->flash('ajoutJour', $s->jourAnnuel . ' jours Bien ajouté à ' .$employe->nom .' '.$employe->prenom);
         return redirect()->route('soldes.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solde = Solde::find($id);

        return view('soldes.show',['solde' => $solde]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solde = Solde::find($id);
        $employe = $solde->employe;
        $employes = Employe::all();  
        return view('soldes.edit',['solde' => $solde,'employe' => $employe,'employes' => $employes]);
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
        $validator = Validator::make($request->all(), [
            'jourAnnuel' => 'required|min:0|not_in:0',
           'cause' => 'required|min:3|max:100',
           ]);
          if ($validator->fails()) {
            return redirect(url()->previous())
           ->withErrors($validator)
            ->withInput();
        }
        $s = Solde::find($id);
        $employe = $s->employe;
         $conge = $employe->conge;
         $jourAnnuel = DB::table('soldes')->select('jourAnnuel')->where('id',$s->id)->pluck('jourAnnuel')->first();
         $s->jourAnnuel = $request->jourAnnuel;
         $s->cause = $request->cause;
         if($employe->nombreConge > 0)
         {
             $employe->nombreConge = $employe->nombreConge - $jourAnnuel + $request->jourAnnuel;
         }
         $employe->save();
         $s->save();
         $request->session()->flash('updatedSolde', 'Les informations ont bien été modifié à '. $employe->nom .' '. $employe->prenom);
         return redirect()->route('soldes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $solde = Solde::find($id);
        $employe = $solde->employe;
        $employe = $solde->employe;
        $employe->nombreConge -= $solde->jourAnnuel;
        $solde->delete();
        $employe->save();
        $request->session()->flash('deletedSolde', 'Solde bien supprimé pour '.$employe->nom . ' '. $employe->prenom);
        return redirect()->route('soldes.index');
    }
    public function pdf()
    {
        $soldes= Solde::all();
        $data = [
            'soldes' => $soldes,
        ];
        $pdf = PDF::loadView('soldes.pdf', $data);
        return $pdf->stream('soldes.pdf',$data);
    }
    public function jourAnnuel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jourAnnuel' => 'required|min:0|not_in:0',
           ]);
          if ($validator->fails()) {
            return redirect(url()->previous())
           ->withErrors($validator)
            ->withInput();
        }
        DB::table('employes')
        ->increment('nombreConge', $request->jourAnnuel);
        $request->session()->flash('increment', $request->jourAnnuel .''.' Jours Bien incremetés aux employés' );
        return redirect()->route('soldes.index');
    }


}