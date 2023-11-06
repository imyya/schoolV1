<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    public function professeurs():BelongsToMany
    {
        return $this->belongsToMany(User::class,"module_professeurs",'module_id','professeur_id');
    }
}
