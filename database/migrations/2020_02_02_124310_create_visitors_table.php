<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('guestName');
            $table->string('guestDesignation');
            $table->string('guestOrg');
            $table->date('visitingDate');
            $table->string('restroom');
            $table->string('bodyguardName');
            $table->string('carNumber');
            $table->string('messengerName');
            $table->string('messengerDesignation');
            $table->string('authorizerName');
            $table->string('authorizerDesignation');
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
        Schema::dropIfExists('visitors');
    }
}
