<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursClasse extends Model
{
    use HasFactory;
    protected $guarded =["id"];

    public function cours():BelongsTo
    {
        return $this->belongsTo(Cours::class);
    }

    public function classe():BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }
}
