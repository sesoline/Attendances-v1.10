<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'ClassName',
        'Details',
        'Year',
        'Owner',
        'OwnerEmail',
        'OwnerTel',
        'Active',
    ];


    protected function students()
    {
        return $this->hasMany(Student::class, "ClassName" , "ClassName");
    }

}
