<?php

namespace App\Http\Resources;

use App\Models\Score;
use MongoDB\BSON\ObjectId;
use App\Http\Resources\FinalScoreResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $scores = Score::where('student_id', '=', new ObjectId($this->_id))->get();
        return [
            '_id' => $this->_id,
            'name' => $this->name,
            'classroom_name' => $this->classroom->name,
            'scores' => FinalScoreResource::collection($scores),
        ];
    }
}
