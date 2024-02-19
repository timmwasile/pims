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
        Schema::table('employee_monthly_payment', function (Blueprint $table) {
            $table->unsignedBigInteger('salary_id')->require()->after('id');
            //  $table->foreign('salary_id')
            //     ->references('id')
            //     ->on('salaries')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_monthly_payment', function (Blueprint $table) {
            //
        });
    }
};
