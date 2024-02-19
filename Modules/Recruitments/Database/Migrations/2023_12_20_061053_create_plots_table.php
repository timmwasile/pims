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
        Schema::create('plots', function (Blueprint $table) {
          $table->id();
            $table->string('number')->unique();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('duration');
            $table->unsignedBigInteger('month_remaining');
            $table->string('description');
            $table->double('total_amount',18,2)->default(0);
            $table->double('to_be_paid_amount',18,2)->default(0);
            $table->double('balance',18,2)->default(0);
            $table->double('mpa',18,2)->default(0);
            $table->double('paid_amount',18,2)->default(0);
            $table->double('penalty',18,2)->default(0);
            $table->string('size');
            $table->date('started_at');
            $table->date('ended_at');
            
            $table->unsignedBigInteger('created_by')->require();
            $table->foreign('created_by')
                ->references('id')
                ->on('admins')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('customer_id')->require();
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('payment_id')->require();
            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('project_id')->require();
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('marketing_officer_id')->require();
            $table->foreign('marketing_officer_id')
                ->references('id')
                ->on('marketing_officers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('plots');
    }
};
