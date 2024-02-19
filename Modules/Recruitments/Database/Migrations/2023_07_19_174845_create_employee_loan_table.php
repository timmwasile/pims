<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_loan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->require();
            $table->unsignedBigInteger('loan_id')->require();
            $table->double('amount',18,2)->default(0);
            $table->double('loan_balance',18,2)->default(0);
             $table->timestamp('started_at')->nullable();
             $table->timestamp('ended_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_loan');
    }
};
