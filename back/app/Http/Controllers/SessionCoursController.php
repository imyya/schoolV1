<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cours;
use App\Models\Classe;
use App\Models\CoursClasse;
use App\Models\SessionCours;
use Illuminate\Http\Request;
use App\Models\ClasseSession;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\SessionResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoresessionCoursRequest;

use App\Http\Requests\UpdatesessionCoursRequest;


class SessionCoursController extends Controller
{
    public function index()
    {
       $sessions= SessionCours::all();
       return response([
        "message" => "voici les sessions",
        "data"=>SessionResource::collection($sessions)
    ], Response::HTTP_ACCEPTED);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function secondesVersHeuresMinutes($secondes)
    // {
    //     $heures = floor($secondes / 3600);
    //     $minutes = floor(($secondes % 3600) / 60);

    //     return [
    //         'heures' => $heures,
    //         'minutes' => $minutes
    //     ];
    // }

    // public function heuresMinutesVersSecondes($heures, $minutes)
    // {
    //     $secondes = ($heures * 3600) + ($minutes * 60);

    //     return $secondes;
    // }

    public function create(Request $request)

    {   //MAKE SURE LA PROF EST LIBRE 
        $coursWithClass=CoursClasse::where(['classe_id'=>$request->classe_id,'cours_id'=>$request->cours_id])->first();
        $sessionsProf = SessionCours::where(['cours_classe_id'=>$coursWithClass->id,'date'=>$request->date])->get();
        foreach($sessionsProf as $session){
            if($session->hd <=$request->hf && $request->hd <=$session->hf ){
                return Response()->json([
                    "message"=>'Le prof est occupe',
                    RESPONSE::HTTP_BAD_REQUEST
                ]);
            }
        }

        //MAKE SURE LA SALLE EST LIBRE
        $sessionsDate = SessionCours::where('date',$request->date)->get();
        if($request->has('salle_id') && $request->salle_id !== ''){ //si le cours se fait en presentiel 
            foreach($sessionsDate as $session){
                if(($session->salle_id === $request->salle_id) && ($session->hd <=$request->hf && $request->hd <=$session->hf)){//check si ce jour la salle est occupee
                    return Response()->json([
                        'message'=>'Salle occupee',
                        RESPONSE::HTTP_BAD_REQUEST
                    ]);
                }
            }
        }


       if ($request->hd >= $request->hf) {
        return response([
            "message" => "L'heure de début doit être antérieure à l'heure de fin."
        ], Response::HTTP_BAD_REQUEST);
      }

      $hd = Carbon::parse($request->hd);
      $hf = Carbon::parse($request->hf);

      if ($hd->diffInHours($hf) < 1) {
          return Response()->json([
              "message" => "L'écart entre l'heure de début et l'heure de fin doit être d'au moins 1 heure."
          ], Response::HTTP_BAD_REQUEST);

      }
      $dateActuelle = Carbon::now();
      if ($dateActuelle->gt($request->date)) {
           return Response()->json([
            "message" => "La date actuelle est ultérieure à la date passée."
        ], Response::HTTP_BAD_REQUEST);
    }

    if ($request->hd >= $request->hf) {
        return Response()->json([
            "message" => "L'heure de début doit être antérieure à l'heure de fin."
        ], Response::HTTP_BAD_REQUEST);
      }

      $hd = Carbon::parse($request->hd);
      $hf = Carbon::parse($request->hf);

      if ($hd->diffInHours($hf) < 1) {
          return Response()->json([
              "message" => "L'écart entre l'heure de début et l'heure de fin doit être d'au moins 1 heure."
          ], Response::HTTP_BAD_REQUEST);

      }
      $dateActuelle = Carbon::now();

      if ($dateActuelle->gt($request->date)) {
           return Response()->json([
            "message" => "La date actuelle est ultérieure à la date passée."
        ], Response::HTTP_BAD_REQUEST);
    }

    $duree= $this->heureMinutesInSeconds($request->hf) - $this->heureMinutesInSeconds($request->hd);
    $cours=Cours::find($request->cours_id);
    if ($cours->hr === $cours->heures) {
        return Response()->json([
            "message" => "les heures de ce cours sont épuisées."
        ], Response::HTTP_BAD_REQUEST);
    }
    if($cours->heures === $cours->hr + $duree) {
        $cours->update(["etat"=>"termine"]);

    }
    if($cours->heures < $cours->hr + $duree) {
        return Response()->json([
            "message" => "Impossible la durée de cette session est supérieure au nombre d'heures restant."
        ], Response::HTTP_BAD_REQUEST);
    }
    $session = SessionCours::create([
        "date"=>$request->date,
        "hd"=>$request->hd,
        "hf"=>$request->hf,
        "duree"=>$duree,
        "cours_classe_id"=>$coursWithClass->id,
        "mode"=>$request->mode,
        "attache_id"=>16,
        "salle_id"=>$request->salle_id


        ]);
     Cours::find($request->cours_id)->increment('hr',$duree);
        ClasseSession::create([
            "classe_id"=>$request->classe_id,
            "session_cours_id"=>$session->id,
            "salle_id"=>$request->salle_id,
        ]);

        DB::commit();

        return Response()->json([
            "message" => "insertion reussie",
            "data"=>$session
        ], Response::HTTP_CREATED);





 

        
    //     $duree= $this->heureMinutesInSeconds($request->hf) - $this->heureMinutesInSeconds($request->hd);

    //     DB::beginTransaction();
    //     $duree= $this->heureMinutesInSeconds($request->hf) - $this->heureMinutesInSeconds($request->hd);

    //    $class= CoursClasse::where("cours_id",$request->cours_id)->first();
    //    $session = SessionCours::create([
    //         "date"=>$request->date,
    //         "hd"=>$request->hd,
    //         "hf"=>$request->hf,
    //         "duree"=>$duree,
    //         "cours_classe_id"=>$class->id,
    //         "mode"=>$request->mode,
    //         "attache_id"=>3,
    //         "salle_id"=>$request->salle_id,

    //     ]);

    //     ClasseSession::create([
    //         "classe_id"=>$request->classe_id,
    //         "session_cours_id"=>$session->id,
    //         "salle_id"=>$request->salle_id,
    //     ]);

    //     DB::commit();

    //     return response([
    //         "message" => "insertion reussie",
    //         "data"=>$session
     
    //     ], Response::HTTP_CREATED);

    }


    public static function heureMinutesInSeconds($heure)
{
    $h=explode(':',$heure);
    $s=isset($h[2])?intval($h[2]):00;
    $secondes= intval($h[0]) * 3600 +  intval($h[1]*60) + $s;
    return $secondes;

}

}
