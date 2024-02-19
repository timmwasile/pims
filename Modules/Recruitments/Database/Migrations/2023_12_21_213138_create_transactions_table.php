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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->double('amount',18,2)->default(0);
            $table->string('description')->nullable();
            $table->unsignedBigInteger('customer_id')->require();
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('project_id')->require();
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onUpdate('cascade')
                ->onDelete('cascade');
$table->unsignedBigInteger('plot_id')->require();
            $table->foreign('plot_id')
                ->references('id')
                ->on('plots')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('created_by')->require();
            $table->foreign('created_by')
                ->references('id')
                ->on('admins')
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
        Schema::dropIfExists('activity_transactions');
    }
};
