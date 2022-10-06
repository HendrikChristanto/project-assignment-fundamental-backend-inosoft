<?php

namespace App\Models;

use App\Models\Student;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'classrooms';

    protected $guarded = ['id'];
}
