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
        Schema::create('invoices_details', function (Blueprint $table) {
            $table->id();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('id_invoices');
            $table->foreign('id_invoices')->references('id')->on('invoices') ->onDelete('cascade');
            $table->string('invoices_number',50);
            $table->string('product',50);
            $table->string('section',999);
            $table->date('Payment_Date')->nullable();
            $table->string('status',50);
            $table->integer('value_status');
            $table->string('user');
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
        Schema::dropIfExists('invoices_details');
    }
};
