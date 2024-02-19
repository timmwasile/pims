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
        Schema::table('admins', function (Blueprint $table) {
        //   $table->unsignedBigInteger('gender_id')->default(1)->after('id');
        //      $table->foreign('gender_id')
        //         ->references('id')
        //         ->on('genders')
        //         ->onUpdate('cascade')
        //         ->onDelete('cascade');

            $table->unsignedBigInteger('company_id')->default(1)->after('id');
             $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
        });
    }
};
