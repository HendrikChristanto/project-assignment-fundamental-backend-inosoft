<?php

namespace App\Http\Controllers\API;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomResource;
use App\Http\Resources\ClassroomsResource;
use Validator;

class ClassroomController extends Controller
{
    public function index()
    {
        $data = ClassroomsResource::collection(Classroom::all());
        $data_json = response()->json($data, 200);
        return $data_json;
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|unique:classrooms',
            'capacity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "The given data was invalid.",
                "errors" => $validator->errors()->toArray(),
            ], 422);
        }
        else {
            $data['capacity'] = (int) $data['capacity'];
            $classroom = Classroom::create($data);
            return response()->json(new ClassroomsResource($classroom), 201);
        }
    }

    public function show($id)
    {
        try
        {   
            $classroom = Classroom::findOrFail($id);
            $data = new ClassroomResource($classroom);
            $data_json = response()->json($data, 200);
            return $data_json;
        }
        catch(ModelNotFoundException $e)
        {
            return response()->json([
                "message" => "The given id was invalid.",
                "error" => "Entry for classroom not found.",
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        $validator = Validator::make($data, [
            'name' => 'nullable|unique:classrooms',
            'capacity' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "The given data was invalid.",
                "errors" => $validator->errors()->toArray(),
            ], 422);
        }
        else {
            try 
            {
                $classroom = Classroom::findOrFail($id);
                $classroom->name = $request->name ? $request->name : $classroom->name;
                $classroom->capacity = $request->capacity ? (int) $request->capacity : $classroom->capacity;
                $status = $classroom->save();
                if ($classroom->save()) {
                    return response()->json(new ClassroomsResource($classroom), 201);
                }
                else {
                    return response()->json(["result" => "failed"], 400);
                }
            }
            catch(ModelNotFoundException $e)
            {
                return response()->json([
                    "message" => "The given id was invalid.",
                    "error" => "Entry for classroom not found.",
                ], 404);
            }
        }
    }
}
