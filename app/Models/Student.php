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
        'Institution_id',
    ];

    protected $attributes = [
        'Photo' => 'images/defaultUser.png',
        'FaceDescriptor' => '',
    ];

    protected function classrooms()
    {
        return $this->hasmany(Student_classroom::class);
    }
}
