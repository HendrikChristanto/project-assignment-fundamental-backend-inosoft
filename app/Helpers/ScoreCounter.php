<?php

namespace App\Helpers;

class ScoreCounter
{
    protected $assignments = array();
    protected $daily_tests = array();
    protected float $midterm_test;
    protected float $final_test;

    public function __construct($assignments, $daily_tests, $midterm_test, $final_test)
    {
        $this->assignments = $assignments;
        $this->daily_tests = $daily_tests;
        $this->midterm_test = $midterm_test;
        $this->final_test = $final_test;
    }

    public function countAssignment(){
        $total_assignment = 0;
        foreach ($this->assignments as $assignment){
            $total_assignment += $assignment;
        }
        return 0.15 * ($total_assignment / 4);
    }

    public function countDailyTest(){
        $total_daily_test = 0;
        foreach ($this->daily_tests as $daily_test){
            $total_daily_test += $daily_test;
        }
        return 0.2 * ($total_daily_test / 2);
    }

    public function countMidtermTest(){
        return 0.25 * $this->midterm_test;
    }

    public function countFinalTest(){
        return 0.4 * $this->final_test;
    }

    public function count(){
        return $this->countAssignment() + $this->countDailyTest() + $this->countMidtermTest() + $this->countFinalTest();
    }
}