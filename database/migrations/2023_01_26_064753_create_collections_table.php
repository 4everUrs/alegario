<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id()->startingValue(10001);
            $table->string('reciepient');
            $table->string('address');
            $table->string('phone');
            $table->unsignedInteger('practitioner_id')->nullable();
            $table->unsignedInteger('installment_id')->nullable();
            $table->string('payment_method');
            $table->string('status');
            $table->bigInteger('amount');
            $table->bigInteger('discount')->nullable();
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
        Schema::dropIfExists('collections');
    }
};
