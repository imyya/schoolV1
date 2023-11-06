<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\CoursClasse;
use Illuminate\Http\Request;
use App\Models\CoursSemestre;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CoursResource;
use App\Http\Resources\CoursClasseResource;

class CoursController extends Controller
{
    public function index()
    {   
        $cours= Cours::all();

        return response([
            "message" => "voici les cours",
            "data"=>CoursResource::collection($cours)
        ], Response::HTTP_OK);

    }

    public static function heureInSeconds($heure)
    {
        $secondes=$heure * 3600;
        return $secondes;
    }
    public function store(Request $request)
    {  
        $request->validate([
            'module_id' => ['required'],
            'semestre_id' => ['required'],
            'professeur_id' => ['required'],

        ]);
        $existingCours = Cours::where('module_id', $request->module_id)
        ->where('semestre_id', $request->semestre_id)
        ->where('professeur_id', $request->professeur_id)
        ->first();

    if ($existingCours) {
        return response([
            "message" => "Ce cours existe déjà."
        ], Response::HTTP_CONFLICT);
    }
      DB::beginTransaction();

      $cours =  Cours::create([
       "module_id"=>$request->module_id,
       "semestre_id"=>$request->semestre_id,
       "professeur_id"=>$request->professeur_id,
       "heures"=>$this->heureInSeconds($request->heures),
        ]);

        // $cours->classe->attach($request->classes);
        // $cours->semestre->attach($request->semestres);

        CoursClasse::create ([

            "classe_id"=>$request->classe_id,
            "cours_id"=>$cours->id,
            "heures"=>0
        ]);
        CoursSemestre:: create([
            "semestre_id"=>$request->semestre_id,
            "cours_id"=>$cours->id
        ]);

        DB::commit();

        return response([
            "message" => "insertion reussie",
            "data"=>$cours
        ], Response::HTTP_ACCEPTED);
    }

    public function getClassesByCours($id)
    {
        $classes= CoursClasse::where("cours_id",$id)->get();
        return response([
            "message" => "voici les classes de ce cours",
            "data"=>CoursClasseResource::collection($classes)
        ], Response::HTTP_OK);
    }

}
