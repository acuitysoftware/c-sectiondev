<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRewardPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_reward_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
             $table->tinyInteger('type')->default(1)->comment("1=>Student Joining,2=>Exam Passed, 3=> Maintain Streak");
             $table->bigInteger('exam_id')->nullable();
             $table->bigInteger('exam_name')->nullable();
             $table->bigInteger('student_id')->nullable();
             $table->bigInteger('student_name')->nullable();
             $table->date('date')->nullable();
             $table->float('points', 10,2)->nullable();
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
        Schema::dropIfExists('student_reward_points');
    }
}
