<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Conge;
use App\Models\Contrat;
use App\Models\Employe;
use App\Models\TypeContrat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class ContratController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employes = Employe::all();
        if(Auth::user()->role == 'admin')
        {
            $contrats = Contrat::when($request->typeContrat,function($query,$typeContrat)
            {
             return $query->where('typeContrat','like','%'.$typeContrat .'%');
            })->when($request->dateContrat,function($query,$dateContrat)
            {
                return $query->where('dateContrat','=',$dateContrat);
            })->when($request->employe_id,function($query,$employe_id)
            {
                return $query->where('employe_id','=',$employe_id);
            })->paginate(5);
            return view('contrats.index',['contrats' => $contrats,'employes' => $employes]);
        }
        $contrats = Contrat::when($request->typeContrat,function($query,$typeContrat)
        {
            return $query->where('typeContrat','like','%'.$typeContrat.'%');
        })->when($request->dateContrat,function($query,$dateContrat)
        {
            return $query->where('dateContrat','=',$dateContrat);
        })->when($request->employe_id,function($query,$employe_id)
        {
            return $query->where('employe_id','=',$employe_id);
        })->where('user_id',auth()->user()->id)->paginate(5);
        return view('contrats.index',['contrats' => $contrats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employes = Employe::all();
        $typeContrats = TypeContrat::all();
        return view('contrats.create',
        ['employes' => $employes,'typeContrats' => $typeContrats]);
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
            'typeContrat' => 'required|min:1',
            'dateContrat' => 'required|date_format:Y-m-d',
           'employe_id' => 'required'
           ]);
       if ($validator->fails()) {
        return redirect(url()->previous())
        ->withErrors($validator)
        ->withInput();
       }
        $c = new Contrat();
        $c->typeContrat = $request->typeContrat;
        $c->employe_id = $request->employe_id;
        $c->dateContrat = $request->dateContrat;
        $c->user_id = $request->employe_id;
        $c->save();
        $request->session()->flash('ajout','Le contrat a bien été ajouté');
        return redirect()->route('contrats.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contrat = Contrat::find($id);

        return view('contrats.show',['contrat' => $contrat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contrat = Contrat::find($id);
        $employe = $contrat->employe;
        $contrats = Contrat::all();
        return view('contrats.edit',['contrat' => $contrat,'employe' => $employe,'contrats' => $contrats]);
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
            'typeContrat' => 'required',
            'dateContrat' => 'required|date_format:Y-m-d',
           ]);
       if ($validator->fails()) {
        return redirect(url()->previous())
        ->withErrors($validator)
        ->withInput();
       }
       $contrat = Contrat::findOrFail($id);
       $employe = $contrat->employe;
       $contrat->typeContrat = $request->typeContrat;
       $contrat->dateContrat = $request->dateContrat;
       $contrat->save();
       $request->session()->flash('updatedContrat','Contrat bien modifié');
       return redirect()->route('contrats.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contrat = Contrat::find($id);
        $contrat->delete();
        return redirect()->route('contrats.index');
    }
    public function pdf()
    {
        $contrats = Contrat::all();
		$data = [
			'contrats' => $contrats,
		];
		$pdf = PDF::loadView('contrats.pdf', $data);
		return $pdf->download('contrats.pdf');
    }
}
