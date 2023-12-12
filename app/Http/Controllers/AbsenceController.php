<?php

namespace App\Http\Controllers;
use PDF;
use Carbon\Carbon;
use App\Models\Absence;
use App\Models\Motif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    if(auth()->user()->role == 'admin')
    $absences = Absence::when($request->motif,function($query,$motif)
    {
        return $query->where('motif','like','%'.$motif .'%');
    })->paginate(5);     
    else
        $absences = Absence::when($request->motif,function($query,$motif)
        {
            return $query->where('motif','like','%'.$motif .'%');
        })->where('employe_id',auth()->user()->id)->paginate(5);  
    $nombreAbsence = Absence::with('employe')->where('employe_id',auth()->user()->id)->count();
     return view('absences.index',['absences'=> $absences,'nombreAbsence' => $nombreAbsence]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nombreAbsence = Absence::with('employe')->where('employe_id',auth()->user()->id)->count();
        $motifs = Motif::all();
        if($nombreAbsence >3)
        return redirect()->route("absences.index")->with('absenceNonAutorise','Vous avez dépassé la limite de demande d absnece');
        else
        return view('absences.create',compact('motifs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'motif' => 'required',
            'dateDebut' => 'required|date_format:Y-m-d',
           'dateFin' => 'required|date_format:Y-m-d'
           ]);
       if ($data->fails()) {
        return redirect(url()->previous())
        ->withErrors($data)
        ->withInput();
       }
        $absence = new Absence();
        $absence->motif = $request->motif;
        $absence->heureDebut = $request->dateDebut;
        $absence->heureFin = $request->dateFin;
        $absence->employe_id = auth()->user()->id;
        $absence->status = false;
        $absence->save();
        $request->session()->flash('success', 'Vous etes enregistré avec succées');
        return redirect()->route('absences.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $absence = Absence::find($id);
        return view('absences.show',compact('absence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $absence = Absence::find($id);  
        return view('absences.edit',compact('absence'));
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
             'motif' => 'required',
             'dateDebut' => 'required|date_format:Y-m-d',
             'dateFin' => 'required|date_format:Y-m-d|after:dateDebut',
           ]);
          if ($validator->fails()) {
            return redirect(url()->previous())
           ->withErrors($validator)
            ->withInput();
              }
                $absence = Absence::findOrFail($id);
                $absence->motif = $request->motif;
                $absence->heureDebut = $request->dateDebut;
                $absence->heureFin = $request->dateFin;
                $absence->modify_absence = auth()->user()->id;
                $absence->update();
                $request->session()->flash('success','Vous a bien modifié l absence');
                return redirect()->route('absences.index');
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
        $absence = Absence::find($id);
        $employe = $absence->employe;
        $absence->delete();
        $request->session()->flash('deletedConge', 'Absence bien Supprimé');
        return redirect()->route('absences.index');
        }
        else{
            $absence = Absence::find($id);
            $absence->delete();
            $request->session()->flash('deletedConge', "Congé bien Supprimé par l'adminitstrateur");
            return redirect()->route('absences.index');
        }
    }
    public function validation($id,Request $request)
    {
        $absence = Absence::find($id);
        $employe = $absence->employe;
        $absence->status = 1;
        $absence->update();
        $request->session()->flash('absenceValide','Absence Validé');
        return redirect()->route('absences.index');
}
public function annuler($id)
{
$absence = Absence::findOrFail($id);
$absence->status = 2;
$absence->update();
return view('absences.annuler',['absence' => $absence]);
}
public function annulerAbsence($id,Request $request)
{
    $absence = Absence::findOrFail($id);
    $employe = $absence->employe;
    $validator = Validator::make($request->all(), [
        'cause' => 'required',
      ]);
     if ($validator->fails()) {
       return redirect(url()->previous())
      ->withErrors($validator)
       ->withInput();
         }
         $absence->cause = $request->cause;
         $absence->status = 2;
         $absence->update();
         $request->session()->flash('messageEnvoye','Le message a bien été envoyé à ' .$employe->nom .' '.$employe->prenom);
         return redirect()->route('absences.index');
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
public function causeAnnuler($id,Request $request)
{
    $absence = Absence::find($id);
    if($absence->cause !== null)
    {
        $cause = $absence->cause;
        return view('absences.causeAnnuler',['cause' => $cause,'absence' => $absence]);
    }
}
}

