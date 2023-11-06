<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SemestreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   //dd($this->annee);
        return [
            "id"=>$this->id,
            "libelle"=>$this->libelle,
            "annee_scolaire"=>new AnneeScolaireResource($this->annee)
        ];
    }
}
