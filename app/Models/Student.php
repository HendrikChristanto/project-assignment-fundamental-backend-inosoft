<?php

namespace App\Models;

use App\Models\Score;
// use Illuminate\Database\Eloquent\Model;
use App\Models\Classroom;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'students';

    protected $guarded = ['id'];

    public function classroom () {
        return $this->belongsTo(Classroom::class);
    }
}
