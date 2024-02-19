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
        Schema::create('marketing_officers', function (Blueprint $table) {
          $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('description');
            $table->string('mobile')->unique();
            $table->string('nida')->unique();
            $table->unsignedBigInteger('created_by')->require();
            $table->softDeletes();
            $table->timestamps();
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
        Schema::dropIfExists('marketing_officers');
    }
};
