<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionCours extends Model
{   public $timestamps = false;

    use HasFactory;
    protected $guarded=["id"];

    public function coursClasses():BelongsTo{
        return $this->belongsTo(CoursClasse::class,"cours_classe_id");
    }
}
