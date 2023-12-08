<?php

namespace App\Models;

use App\Models\User;
use App\Models\Solde;
use App\Models\Employe;
use App\Models\TypeConge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conge extends Model
{
    protected $fillable = ['employe_id','typeConge_id','dateDebut','dateFin'];
    protected $guarded = [];
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function typeConge()
    {
        return $this->hasOne(TypeConge::class,'id','typeConge_id');
    }
    public function employe()
    {
        return $this->belongsTo(Employe::class,'employe_id','id');
    }
    public function solde()
    {
        return $this->hasMany(Solde::class,'id','conge_id');
    }
}
