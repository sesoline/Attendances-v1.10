<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'FirstName',
        'LastName',
        'Telephone',
        'email',
        'Address',
        'Photo',
        'ClassName',
    ];

    protected $attributes = [
        'Photo' => 'Juli.png',
    ];
}
