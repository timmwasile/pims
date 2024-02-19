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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->double('amount',18,2)->default(0);
            $table->string('customer_name')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamp('invoice_no')->nullable();
            $table->timestamp('invoice_date')->nullable();
            $table->timestamp('derivered_date')->nullable();
            $table->unsignedBigInteger('created_by');
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
        Schema::dropIfExists('invoices');
    }
};
