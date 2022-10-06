<?php

namespace App\Http\Resources;

use App\Helpers\ScoreCounter;
use Illuminate\Http\Resources\Json\JsonResource;

class FinalScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $assignments = array($this->assignment_1, $this->assignment_2, $this->assignment_3, $this->assignment_4);
        $daily_tests = array($this->daily_test_1, $this->daily_test_2);
        $score = new ScoreCounter($assignments, $daily_tests, $this->midterm_test, $this->final_test);
        return [
            'subject_name' => $this->subject->name,
            'final_score' => $score->count(),
        ];
    }
}
