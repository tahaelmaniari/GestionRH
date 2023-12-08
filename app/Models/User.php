<?php

namespace App\Models;

use App\Models\Conge;
use App\Models\Employe;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','email','password','confirmPassword','photo'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function employe()
    {
        return $this->hasOne(Employe::class,'id','user_id');
    }
    public function conge()
    {
        return $this->hasMany(Conge::class,'id','user_id');
    }
    public function contrat()
    {
        return $this->belongsTo(Contrat::class,'id','user_id');
    }
}
