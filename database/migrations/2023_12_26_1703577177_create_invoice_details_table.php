<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->unsignedBigInteger('billId')->primary();
            $table->unsignedBigInteger('billDocId');
            $table->foreign('billDocId')->references('docId')->on('invoice_headers');
            $table->string('billCode', 2)->nullable();
            $table->string('billNo', 18)->nullable();
            $table->string('billName', 20)->nullable();
            $table->string('billShortName', 10)->nullable();
            $table->string('billDescription', 18)->nullable();
            $table->decimal('billAmount', 10, 0)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
}
