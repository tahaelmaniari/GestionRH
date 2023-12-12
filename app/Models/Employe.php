<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Conge;
use App\Models\Solde;
use App\Models\Contrat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employe extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    use HasFactory;
    public function contrat()
    {
        return $this->hasOne(Contrat::class,'employe_id','id');
    }
    public function conge()
    {
        return $this->hasMany(Conge::class,'employe_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function solde()
    {
        return $this->hasMany(Solde::class,'id','employe_id');
    }
    public function takenDays($exeptId = null)
    {
        if($exeptId)
        {
            $conges = Conge::where('employe_id',$this->id)
            ->where('id','<>',$exeptId)
            ->whereYear('dateDebut',Carbon::now()->year)->get();
        }
        else
        {
        $conges = Conge::where('employe_id',$this->id)
        ->whereYear('dateDebut',Carbon::now()->year)->get();
        }
        $totalDaysTaken = 0;      
        foreach($conges as $conge)
        {
        $dateDebut = Carbon::parse($conge->dateDebut);
        $dateFin = Carbon::parse($conge->dateFin);
        $totalDays = $dateFin->diffInDays($dateDebut);
        $totalDaysTaken += $totalDays;
        }
        return $totalDaysTaken;
    }
    public function typeConge()
    {
        return $this->hasOne(TypeConge::class,'typeConge_id','id');
    }
    public function absence():HasMany
    {
        return $this->hasMany(Absence::class);
    }

}