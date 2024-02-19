<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('photo', 120)->nullable();
            $table->string('phone_no', 12)->nullable();
            $table->string('website', 120)->nullable();
            $table->string('job_title', 120)->nullable();
            $table->string('nin', 20);
            $table->string('address', 120)->nullable();
            $table->string('facebook_url', 120)->nullable();
            $table->string('twitter_url', 120)->nullable();
            $table->string('linkedin_url', 120)->nullable();
            $table->dateTime('dob')->nullable();
            $table->string('country', 60);
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
        Schema::dropIfExists('profiles');
    }
};
