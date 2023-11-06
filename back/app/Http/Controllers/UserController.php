<?php

namespace App\Http\Controllers;
use App\Http\Resources\CoursResource;
use App\Http\Resources\SessionResource;
use App\Imports\UserImport;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\CoursClasse;
use App\Models\Inscription;
use App\Models\Module;
use App\Models\ModuleProfesseur;
use App\Models\SessionCours;
use App\Models\User;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function import( Request $request)
    {
        $file=$request->file('file');
       // Excel::import(new UsersImport, $fichier);

        $studs=Excel::toArray(new UserImport,$file);
        // return $eleves;
        foreach ($studs as $s) {
            foreach ($s as $eleve) {
                $el=(new UserImport)->model($eleve);
                $el->save();
                $id=$el->id;

                Inscription::create([
                    "eleve_id"=>$id,
                    "classe_id"=>$request->classe_id,
                    "annee_scolaire_id"=>$request->annee_scolaire_id
                ]);
                $classe=  Classe::where("id",$request->classe_id)->first();
                $classe->increment('effectif');
              }
          }
          return response()->json([
             "message"=>"inscription réussie",
          ]);
      }
}
