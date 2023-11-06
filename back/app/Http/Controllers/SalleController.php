<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SalleController extends Controller
{
    public function index()
    {
        $salles=Salle::all();
        return response([
            "message" => "voici les salles",
            "data"=>$salles
        ], Response::HTTP_OK);
    }
}
