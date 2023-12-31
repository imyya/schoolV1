<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'prenom'     => $row[0],
            'nom'     => $row[1],
            'email'    => $row[2],
            'password' => Hash::make($row[3]),
            'role'=>'eleve'
        ]);
    }
}
