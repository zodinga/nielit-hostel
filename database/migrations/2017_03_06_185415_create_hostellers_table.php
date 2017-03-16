<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostellers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id');
            $table->string('name',50);
            $table->integer('course_id');
            $table->string('phone',12)->nullable();
            $table->string('guardian',50)->nullable();
            $table->string('guardian_phone',12)->nullable();
            $table->date('admission_date');
            $table->date('leave_date')->nullable();
            $table->tinyInteger('status')->unsigned();
            $table->string('remarks')->nullable();
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
        Schema::drop('hostellers');
    }
}
