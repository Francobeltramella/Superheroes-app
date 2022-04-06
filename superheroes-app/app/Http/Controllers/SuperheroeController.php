<?php

namespace App\Http\Controllers;

use App\Http\Resources\SuperheroResources;
use App\Http\Services\ApiService;
use App\Imports\SuperheroeImport;
use App\Models\Superheroe;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SuperheroeController extends Controller
{
    public function import(Request $request)
    {
        Excel::import(new SuperheroeImport, $request->file);
        return back();
    }


    //Get all Superheroes
    public function getAllSuperheroes()
    {
        $superheroes = Superheroe::orderBy('name','desc')
                                            ->paginate(10);
        return SuperheroResources::collection($superheroes);
    }

    //Get three fastest Superheroes
    public function geThreeFastestSuperheroes()
    {
        $superheroes = Superheroe::orderBy('speed','desc')
                                            ->take(3)
                                            ->get();
        return SuperheroResources::collection($superheroes);
    }


    //Get  race Superhero INPUT
    public function getRaceSuperheroe(Request $request , $race)
    {
        $race = $request->input('race');     
        $superheroes = Superhero::Where('race', 'LIKE', "%$race%" )
                                            ->paginate(10);
        return SuperheroResources::collection($superheroes);
    }

    //Get the most powerfull Superheroe
    public function getPowerfulSuperheroe()
    {
           
        $superheroes = Superheroe::orderBy('power','desc')
                                ->orderBy('strength', 'desc')
                                ->orderBy('durability', 'desc')
                                ->orderBy('combat', 'desc')
                                ->orderBy('speed', 'desc')
                                
                                        ->take(1)
                                        ->get();
        return SuperheroResources::collection($superheroes);
    }



}
