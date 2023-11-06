<?php

namespace App\Http\Controllers;

use App\Models\Semestre;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\SemestreResource;

class SemestreController extends Controller
{
    public function index()
    {
        $semestres=Semestre::all();
        return response([
            "message" => "voici les semestre",
            "data"=>SemestreResource::collection($semestres)
        ], Response::HTTP_OK);
    }
}
