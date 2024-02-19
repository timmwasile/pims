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
        Schema::create('activities', function (Blueprint $table) {
           $table->id();
            $table->string('name')->unique();
            $table->double('budget',18,2)->default(0);
            $table->double('utilised')->default(0);
            $table->double('balance')->default(0);
            $table->unsignedBigInteger('created_by')->require();
            $table->unsignedBigInteger('fyear_id')->require();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('fyear_id')->references('id')->on('fyears')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('created_by')
                ->references('id')
                ->on('admins')
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
        Schema::dropIfExists('activities');
    }
};
