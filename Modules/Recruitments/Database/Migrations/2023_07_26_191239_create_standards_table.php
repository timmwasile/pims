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
        Schema::create('standards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->required();
            $table->unsignedBigInteger('salary_id')->required();
            $table->double('basic',18,2)->default(0);
            $table->double('paye',18,2)->default(0);
            $table->double('nhif',18,2)->default(0);
            $table->double('nssf',18,2)->default(0);
            $table->date('started_at');
            $table->date('ended_at');
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
        Schema::dropIfExists('standards');
    }
};
