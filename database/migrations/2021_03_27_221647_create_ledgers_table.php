<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('name',191)->nullable();
            $table->enum('type',['Customer','Vendor','Investment','Other']);
            $table->unsignedBigInteger('cust_id')->nullable();
            $table->foreign('cust_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status',['Jamah','Name','Clear']);
            $table->bigInteger('amount')->default(0);
            $table->bigInteger('j_amount')->default(0);
            $table->bigInteger('n_amount')->default(0);
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
        Schema::dropIfExists('ledgers');
    }
}
