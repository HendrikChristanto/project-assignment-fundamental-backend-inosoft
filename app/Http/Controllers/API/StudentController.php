<?php

namespace App\Http\Controllers\API;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentsResource;

class StudentController extends Controller
{
    public function index()
    {
        $data = StudentsResource::collection(Student::all());
        $data_json = response()->json($data, 200);
        return $data_json;
    }

    public function show($id)
    {
        try
        { 
            $student = Student::findOrFail($id);
            $data = new StudentResource($student);
            $data_json = response()->json($data, 200);
            return $data_json;
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json([
                "message" => "The given id was invalid.",
                "error" => "Entry for student not found.",
            ], 404);
        }
    }
}
