<?php

namespace App\Http\Resources;

use App\Helpers\ScoreCounter;
use Illuminate\Http\Resources\Json\JsonResource;

class ScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'student_name' => $this->student->name,
            'subject_name' => $this->subject->name,
            'assignment_1' => $this->assignment_1,
            'assignment_2' => $this->assignment_2,
            'assignment_3' => $this->assignment_3,
            'assignment_4' => $this->assignment_4,
            'daily_test_1' => $this->daily_test_1,
            'daily_test_2' => $this->daily_test_2,
            'midterm_test' => $this->midterm_test,
            'final_test' => $this->final_test,
        ];
    }
}
