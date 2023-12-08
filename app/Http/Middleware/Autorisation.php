<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Autorisation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // return redirect()->route('users.informations');
        if(Auth::user() && Auth::user()->role == 'admin')
        {
        return $next($request);
        }
             //$request->session()->flush('Autorisation',"Vouz n'avez pas le droit d'accéder à ces fonctionnalités !");
                     //dd(auth()->user());

            return redirect('/users/informations')->with('autorisation',"Vouz n'avez pas le droit d'accéder à ces fonctionnalités !");
            
}

}
