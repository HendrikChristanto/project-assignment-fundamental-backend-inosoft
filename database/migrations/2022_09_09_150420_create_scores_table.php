<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->unique(['student_id', 'subject_id']);
            $table->float('assignment_1');
            $table->float('assignment_2');
            $table->float('assignment_3');
            $table->float('assignment_4');
            $table->float('daily_test_1');
            $table->float('daily_test_2');
            $table->float('midterm_test');
            $table->float('final_test');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
