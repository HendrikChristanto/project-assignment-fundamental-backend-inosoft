<?php

namespace App\Models;

use App\Models\Student;
// use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'scores';

    protected $guarded = ['id'];

    public function student () {
        return $this->belongsTo(Student::class);
    }

    public function subject () {
        return $this->belongsTo(Subject::class);
    }
}
