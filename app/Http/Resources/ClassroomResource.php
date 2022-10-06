<?php

namespace App\Http\Resources;

use App\Models\Student;
use Illuminate\Http\Resources\Json\JsonResource;
use MongoDB\BSON\ObjectId;

class ClassroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $student = Student::select(['_id', 'name'])->where('classroom_id', '=', new ObjectId($this->_id))->get();
        return [
            '_id' => $this->_id,
            'name' => $this->name,
            'capacity' => $this->capacity,
            'students' => $student,
        ];
    }
}
