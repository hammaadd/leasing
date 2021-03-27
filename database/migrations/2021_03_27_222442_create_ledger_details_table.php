<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledger_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ledger_no')->nullable();
            $table->foreign('ledger_no')->references('id')->on('ledgers');
            $table->enum('status',['Jamah','Name','Clear']);
            $table->bigInteger('amount')->default(0);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('ledger_details');
    }
}
