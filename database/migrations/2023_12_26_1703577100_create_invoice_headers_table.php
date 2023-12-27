<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceHeadersTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_headers', function (Blueprint $table) {
            $table->string('docId')->primary();
            $table->string('customerNo', 20)->nullable();
            $table->string('debtorAcct', 10)->nullable();
            $table->string('virtualAccountName')->nullable();
            $table->string('lotNo', 10)->nullable();
            $table->string('virtualAccountEmail')->nullable();
            $table->datetime('docDate')->nullable();
            $table->datetime('dueDate')->nullable();
            $table->decimal('totalAmount', 10, 0)->nullable();
            $table->decimal('prevBill', 10, 0)->nullable();
            $table->decimal('payFine', 10, 0)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_headers');
    }
}
