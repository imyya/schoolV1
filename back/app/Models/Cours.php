<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{
    use HasFactory;
    protected $guarded=["id"];

    public function module()
{
    return $this->belongsTo(Module::class);
}

public function semestre()
{
    return $this->belongsTo(Semestre::class);
}

public function professeur()
{
    return $this->belongsTo(User::class, 'professeur_id');
}

}
