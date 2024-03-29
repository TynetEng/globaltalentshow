<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VoterPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voterPayments', function (Blueprint $table) {
            $table->id();
            $table->string('contestantName');
            $table->string('modeOfPayment');
            $table->string('paidAt');
            $table->string('invoiceId');
            $table->string('amount');
            $table->string('voterName');
            $table->string('customerId');
            $table->bigInteger('user_id');
            $table->bigInteger('contestant_id');
            $table->rememberToken();
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
        Schema::dropIfExists('voterPayments');
    }
}
