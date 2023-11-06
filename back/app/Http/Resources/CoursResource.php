<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "module" => new ModuleResource($this->module),
           "semestre" => new SemestreResource($this->semestre),
           "professeur" => new UserResource($this->professeur),
            "heures"=>$this->secondesVersHeures($this->heures),
            "hr"=>$this->secondesVersHeuresMinutes($this->hr),
            // "classe"=>$this->classe->map(function($c){
            //     return [
            //         "id"=>$c->pivot->id,
            //         // "heures"=>$c->pivot->heures
            //     ];
            // }),
            // "semestre"=>$this->semestre->map(function($s){
            //     return [
            //         "libelle"=>$s->libelle
            //     ];
            // })
        ];
    }

    public function secondesVersHeures($secondes)
    {
        return floor($secondes / 3600);

    }
    public function secondesVersHeuresMinutes($secondes)
    {
        $heures = floor($secondes / 3600);
        $minutes = floor(($secondes % 3600) / 60);

        return [
            'heures' => $heures,
            'minutes' => $minutes
        ];
    }
}
