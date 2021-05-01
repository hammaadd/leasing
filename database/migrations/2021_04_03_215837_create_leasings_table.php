<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeasingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leasings', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('acc_no')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->bigInteger('advance')->nullable();
            $table->bigInteger('current_price')->nullable();
            $table->bigInteger('total')->nullable();
            $table->integer('tenure')->nullable();
            $table->enum('tenure_in',['Months','Years'])->default('Years');
            $table->bigInteger('installment')->nullable();
            $table->enum('plan',['Monthly','Daily','Weekly'])->nullable();
            $table->string('check')->nullable();
            $table->string('bank_name')->nullable();
            $table->bigInteger('check_amount')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('leasings');
    }
}
