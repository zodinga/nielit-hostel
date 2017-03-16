<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mess_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('hosteller_id');
            $table->date('date');
            $table->string('receipt_no',50)->nullable();
            $table->string('month',10);
            $table->string('year',4);
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
        Schema::drop('mess_fees');
    }
}
