<?php

namespace App\Models;

use App\Models\Subject;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'subjects';

    protected $guarded = ['id'];
}
