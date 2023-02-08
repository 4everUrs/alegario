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
        Schema::create('budget_requests', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->string('requestor');
            $table->string('description');
            $table->bigInteger('amount')->nullable();
            $table->bigInteger('approved_amount')->nullable();
            $table->string('date_approved')->nullable();
            $table->string('file_name')->nullable();
            $table->string('original_file_name')->nullable();
            $table->string('status')->nullable()->default('Pending');
            $table->string('remarks')->nullable()->default('N/A');
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
        Schema::dropIfExists('budget_requests');
    }
};
