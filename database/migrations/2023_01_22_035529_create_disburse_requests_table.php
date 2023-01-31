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
        Schema::create('disburse_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('budget_requests_id');
            $table->string('status');
            $table->bigInteger('approve_amount')->nullable();
            $table->string('date_aproved')->nullable();
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
        Schema::dropIfExists('disburse_requests');
    }
};
