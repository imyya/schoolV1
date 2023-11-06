<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\CoursClasseResource;
use App\Http\Resources\ClasseResource;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\CoursClasse;
use App\Models\CoursSemestre;
use Illuminate\Support\Facades\DB;

use Symfony\Component\HttpFoundation\Response;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes= Classe::all();

        return response([
            "message" => "voici les classe",
            "data"=>ClasseResource::collection($classes)
        ], Response::HTTP_OK);

    }

    public function getClassesByCours($id)
    {
        $classes= CoursClasse::where("cours_id",$id)->get();
        return response([
            "message" => "voici les classes de ce cours",
            "data"=>CoursClasseResource::collection($classes)
        ], Response::HTTP_OK);
    }
    public function coursClasses($idCours,$idClasse)
    {
        $coursClasses= CoursClasse::where([["cours_id",$idCours],["classe_id",$idClasse]])->get();
        return response([
            "message" => "voici les classes",
            "data"=>$coursClasses
        ], Response::HTTP_OK);
    }

    public function all()
    {
        $all=CoursClasse::all();
        return response([
            "message" => "voici",
            "data"=>$all
        ], Response::HTTP_OK);
    }
    /**
     * Show the form for creating a new resource.
     */


    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */

}


