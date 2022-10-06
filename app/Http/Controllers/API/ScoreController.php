<?php

namespace App\Http\Controllers\API;

use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScoreResource;
use MongoDB\BSON\ObjectId;
use Validator;

class ScoreController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'student_id' => 'required|exists:students,_id',
            'subject_id' => 'required|exists:subjects,_id',
            'assignment_1' => 'required|numeric|min:0|max:100',
            'assignment_2' => 'required|numeric|min:0|max:100',
            'assignment_3' => 'required|numeric|min:0|max:100',
            'assignment_4' => 'required|numeric|min:0|max:100',
            'daily_test_1' => 'required|numeric|min:0|max:100',
            'daily_test_2' => 'required|numeric|min:0|max:100',
            'midterm_test' => 'required|numeric|min:0|max:100',
            'final_test' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "The given data was invalid.",
                "errors" => $validator->errors()->toArray(),
            ], 422);
        }
        else {
            $data['student_id'] = new ObjectId($data['student_id']);
            $data['subject_id'] = new ObjectId($data['subject_id']);
            $data['assignment_1'] = (float) $data['assignment_1'];
            $data['assignment_2'] = (float) $data['assignment_2'];
            $data['assignment_3'] = (float) $data['assignment_3'];
            $data['assignment_4'] = (float) $data['assignment_4'];
            $data['daily_test_1'] = (float) $data['daily_test_1'];
            $data['daily_test_2'] = (float) $data['daily_test_2'];
            $data['midterm_test'] = (float) $data['midterm_test'];
            $data['final_test'] = (float) $data['final_test'];
            $score = Score::create($data);
            return response()->json(new ScoreResource($score), 201);
        }
    }

    public function show($id)
    {
        try
        {  
            $score = Score::findOrFail($id);
            $data = new ScoreResource($score);
            $data_json = response()->json($data, 200);
            return $data_json;
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json([
                "message" => "The given id was invalid.",
                "error" => "Entry for score not found.",
            ], 404);
        }
    }
}
