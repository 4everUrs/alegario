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
        Schema::create('installments', function (Blueprint $table) {
            $table->id()->startingValue(1001);
            $table->unsignedInteger('collection_id');
            $table->unsignedInteger('recievable_id');
            $table->bigInteger('amount');
            $table->bigInteger('downpayment');
            $table->bigInteger('monthly_due');
            $table->bigInteger('paid_amount');
            $table->bigInteger('balance')->nullable();
            $table->integer('paid')->nullable()->default(0);
            $table->integer('terms');
            $table->integer('interest');
            $table->string('status')->nullable()->default('Unpaid');
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
        Schema::dropIfExists('installments');
    }
};
