<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContestantDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contestantDetails', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('information');
            $table->string('image');
            $table->string('contestantEmail');
            $table->timestamp('created_at')->now();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contestantDetails');
    }
}
// https://triplebyte.com/tb/oluwatoyin-janet-gitx7yg/certificate