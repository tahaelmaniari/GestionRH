<?php

namespace App\Models;

use App\Models\Conge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeConge extends Model
{
    use HasFactory,SoftDeletes;
public function conge()
{
return $this->hasMany(Conge::class);
}

}
