<?php

namespace App\Models;

use App\Models\Employe;
use App\Models\TypeContrat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrat extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $fillable = ['id','typeContrat','dateContrat','employe_id','user_id'];
    public function employe()
    {
        return $this->belongsTo(Employe::class,'employe_id','id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'user_id','id');
    }
    public function typeContrats()
    {
        return $this->belongsTo(TypeContrat::class);
    }
}
