<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Client\Response;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\ModuleProfesseursResource;
use App\Http\Resources\ModuleProfResource;
use App\Models\ModuleProfesseurs;
use App\Models\ModuleProf;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ModuleController extends Controller
{    public function index()
    {
        $modules=Module::with('professeurs')->get();
        return response([
            "message" => "voici les modules",
            "data"=>ModuleResource::collection($modules)
        ], Response::HTTP_OK);
    }
    public function getProfsByModule($id)
    {
        $modProfs= Module::with('professeurs')->find($id);
      //  return $modProfs;
        return response([
            "data"=>new ModuleResource($modProfs)
        ], Response::HTTP_OK);

    }

}
