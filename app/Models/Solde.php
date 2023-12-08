<?php

namespace App\Models;

use App\Models\Conge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solde extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function employe()
    {
        return $this->belongsTo(Employe::class,'employe_id','id');
    }
    public function conge()
    {
        return $this->belongsTo(Conge::class,'conge_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
