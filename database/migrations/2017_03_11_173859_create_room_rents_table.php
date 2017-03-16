<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_rents', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('hosteller_id');
            $table->date('date');
            $table->string('receipt_no',50)->nullable();
            $table->date('from');
            $table->date('to');
            $table->decimal('amount', 10, 2);
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
        Schema::drop('room_rents');
    }
}
