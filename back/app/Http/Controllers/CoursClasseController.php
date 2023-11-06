<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoursClasseController extends Controller
{
    
    // public function getClasses($id)
    // {
    //     $classes= CoursClasse::where("cours_id",$id)->get();
    //     return response([
    //         "message" => "voici les classes",
    //         "data"=>CoursClasseResource::collection($classes)
    //     ], Response::HTTP_OK);
    // }
    // public function coursClasses($idCours,$idClasse)
    // {
    //     $coursClasses= CoursClasse::where([["cours_id",$idCours],["classe_id",$idClasse]])->get();
    //     return response([
    //         "message" => "voici les classes",
    //         "data"=>$coursClasses
    //     ], Response::HTTP_OK);
    // }

    // public function all()
    // {
    //     $all=CoursClasse::all();
    //     return response([
    //         "message" => "voici",
    //         "data"=>$all
    //     ], Response::HTTP_OK);
    // }
}
