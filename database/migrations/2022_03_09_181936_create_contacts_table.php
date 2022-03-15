<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('phone_e164');
            $table->string('phone_national');
            $table->string('phone');
            $table->string('phone_country');
            $table->foreignId('team_id');
            $table->foreignId('phonebook_id');
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('unit')->nullable();
            $table->string('lga')->nullable();
            $table->string('state')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->string('business')->nullable();
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
        Schema::dropIfExists('contacts');
    }
};
