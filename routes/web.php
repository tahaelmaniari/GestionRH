<?php

use App\Http\Controllers\AbsenceController;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PostUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\SoldeController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\SocieteController;
use App\Models\Conge;
use App\Models\Contrat;
use App\Models\Employe;
use App\Models\Solde;
use App\Models\TypeConge;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Artisan::call('cache:clear');
Artisan::call('config:cache');
Artisan::call('view:clear');*/
Route::get('password',function()
{
    dd(Hash::make('password'));
});

Route::get('/',function()
{
return redirect()->route('users.informations');
});
Route::get('create',[CongeController::class,'createData']);


Auth::routes();
Route::prefix('users')->group(function(){
    //Route::get('/create',[UserController::class,'create'])->name('users.create');
    //Route::get('/',[UserController::class,'index'])->name('users.index');
    //Route::post('/store',[UserController::class,'store'])->name('users.store');
    //Route::get('/show/{id}',[UserController::class,'show'])->name('users.show');
    Route::put('/update/{id}',[UserController::class,'update'])->name('users.update');
    Route::get('/edit/{id}',[UserController::class,'edit'])->name('users.edit');
    //Route::delete('/destroy/{id}',[UserController::class,'destroy'])->name('users.destroy');
    Route::get('/pdf',[UserController::class,'pdf'])->name('users.pdf');
    Route::get('/informations',[UserController::class,'informations'])->name('users.informations');
});
Route::prefix('conges')->group(function()
{
Route::get('/',[CongeController::class,'index'])->name('conges.index');
Route::get('/create',[CongeController::class,'create'])->name('conges.create');
Route::get('/show/{id}',[CongeController::class,'show'])->name('conges.show');
Route::post('/store',[CongeController::class,'store'])->name('conges.store');
Route::get('/edit/{id}',[CongeController::class,'edit'])->name('conges.edit');
Route::put('/update/{id}',[CongeController::class,'update'])->name('conges.update');
Route::delete('/destroy/{id}',[CongeController::class,'destroy'])->name('conges.destroy');
Route::get('/pdf',[CongeController::class,'pdf'])->name('conges.pdf');
Route::post('/annulerConge/{id}',[CongeController::class,'annulerConge'])->name('conges.annulerConge');
Route::get('/congeAnnuler/{id}',[CongeController::class,'congeAnnuler'])->name('conges.congeAnnuler');
Route::post('/redemanderConge/{id}',[CongeController::class,'redemanderConge'])->name('conges.redemanderConge');
Route::get('/pdfOmia/{id}',[CongeController::class,'pdfOmia'])->name('conges.pdfOmia');
Route::post('/jourAnnuel',[CongeController::class,'jourAnnuel'])->name('conges.jourAnnuel');
});
Route::prefix('societes')->group(function(){
Route::get('/societe',[SocieteController::class,'index'])->name('societe.index');
Route::get('/societe/{id}',[SocieteController::class,'show'])->name('societe.show');
});

Route::prefix('employes')->group(function()
{
//Route::get('/create',[EmployeController::class,'create'])->name('employes.create');
Route::get('/',[EmployeController::class,'index'])->name('employes.index');
//Route::post('/store',[EmployeController::class,'store'])->name('employes.store');
//Route::get('/show/{id}',[EmployeController::class,'show'])->name('employes.show');
//Route::put('/update/{id}',[EmployeController::class,'update'])->name('employes.update');
//Route::get('/edit/{id}',[EmployeController::class,'edit'])->name('employes.edit');
//Route::delete('/destroy/{id}',[EmployeController::class,'destroy'])->name('employes.destroy');
Route::get('/pdf',[EmployeController::class,'pdf'])->name('employes.pdf');
});
Route::prefix('contrats')->group(function()
{
//Route::get('/create',[ContratController::class,'create'])->name('contrats.create');
Route::get('/',[ContratController::class,'index'])->name('contrats.index');
//Route::post('/store',[ContratController::class,'store'])->name('contrats.store');
//Route::get('/show/{id}',[ContratController::class,'show'])->name('contrats.show');
//Route::put('/update/{id}',[ContratController::class,'update'])->name('contrats.update');
//Route::get('/edit/{id}',[ContratController::class,'edit'])->name('contrats.edit');
//Route::delete('/destroy/{id}',[ContratController::class,'destroy'])->name('contrats.destroy');
Route::get('/pdf',[ContratController::class,'pdf'])->name('contrats.pdf');
});
Route::group(['middleware' => ['autorisation']],function(){ 
    Route::prefix('employes')->group(function(){
        Route::get('/create',[EmployeController::class,'create'])->name('employes.create');
        Route::get('/',[EmployeController::class,'index'])->name('employes.index');
        Route::post('/store',[EmployeController::class,'store'])->name('employes.store');
        Route::get('/show/{id}',[EmployeController::class,'show'])->name('employes.show');
        Route::put('/update/{id}',[EmployeController::class,'update'])->name('employes.update');
        Route::get('/edit/{id}',[EmployeController::class,'edit'])->name('employes.edit');
        Route::delete('/destroy/{id}',[EmployeController::class,'destroy'])->name('employes.destroy');
        Route::post('changeRole/{id}',[EmployeController::class,'changeRole'])->name('employes.changeRole');
        Route::post('changeAdmin/{id}',[EmployeController::class,'changeAdmin'])->name('employes.changeAdmin');

        //Route::get('/pdf',[EmployeController::class,'pdf'])->name('employes.pdf');
    });

    Route::prefix('contrats')->group(function(){
     Route::get('/create',[ContratController::class,'create'])->name('contrats.create');
     //Route::get('/',[ContratController::class,'index'])->name('contrats.index');
     Route::post('/store',[ContratController::class,'store'])->name('contrats.store');
     Route::get('/show/{id}',[ContratController::class,'show'])->name('contrats.show');
     Route::put('/update/{id}',[ContratController::class,'update'])->name('contrats.update');
     Route::get('/edit/{id}',[ContratController::class,'edit'])->name('contrats.edit');
     Route::delete('/destroy/{id}',[ContratController::class,'destroy'])->name('contrats.destroy');
     //Route::get('/pdf',[ContratController::class,'pdf'])->name('contrats.pdf');
    });
Route::prefix('conges')->group(function()
{
Route::post('/annuler/{id}',[CongeController::class,'annuler'])->name('conges.annuler');
Route::post('/validation/{id}',[CongeController::class,'validation'])->name('conges.validation');
});
Route::prefix('users')->group(function(){
    Route::get('/create',[UserController::class,'create'])->name('users.create');
    Route::get('/',[UserController::class,'index'])->name('users.index');
    Route::post('/store',[UserController::class,'store'])->name('users.store');
    Route::get('/show/{id}',[UserController::class,'show'])->name('users.show');
    Route::delete('/destroy/{id}',[UserController::class,'destroy'])->name('users.destroy');
    //Route::get('/pdf',[UserController::class,'pdf'])->name('users.pdf');
    //Route::get('/informations',[UserController::class,'informations'])->name('users.informations');
});
Route::prefix('soldes')->group(function(){
    Route::get('/create',[SoldeController::class,'create'])->name('soldes.create');
    Route::get('/',[SoldeController::class,'index'])->name('soldes.index');
    Route::post('/store',[SoldeController::class,'store'])->name('soldes.store');
    Route::get('/show/{id}',[SoldeController::class,'show'])->name('soldes.show');
    Route::put('/update/{id}',[SoldeController::class,'update'])->name('soldes.update');
    Route::get('/edit/{id}',[SoldeController::class,'edit'])->name('soldes.edit');
    Route::delete('/destroy/{id}',[SoldeController::class,'destroy'])->name('soldes.destroy');
    Route::post('/jourAnnuel',[SoldeController::class,'jourAnnuel'])->name('soldes.jourAnnuel');
    Route::get('/pdf',[SoldeController::class,'pdf'])->name('soldes.pdf');
});
});
Route::resource('absences',AbsenceController::class);
Route::get('/absence/pdf',[AbsenceController::class,'pdf'])->name('absences.pdf');
Route::prefix('absence')->group(function()
{
Route::post('/annuler/{id}',[AbsenceController::class,'annuler'])->name('absence.annuler');
Route::post('/validation/{id}',[AbsenceController::class,'validation'])->name('absences.validation');
Route::post('/annulerAbsence/{id}',[AbsenceController::class,'annulerAbsence'])->name('absence.annulerAbsence');
Route::get('/annulerAbsence/{id}',[AbsenceController::class,'causeAnnuler'])->name('absences.absenceAnnuler');

});