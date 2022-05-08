<?php

use App\Enums\MessageStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('messages', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->references('id')->on('senders');
            $table->foreignId('contact_id')->nullable()->references('id')->on('contacts');
            $table->foreignId('sent_by')->references('id')->on('users');
            $table->foreignId('team_id')->references('id')->on('teams');
            $table->text('message');
            $table->string('receiver');
            $table->string('phone_e164');
            $table->tinyInteger('status')->default(MessageStatus::scheduled->value);
            $table->dateTime('scheduled_at');
            $table->tinyInteger('pages')->default(0);
            $table->dateTime('sent_at')->nullable();
            $table->string('cost')->nullable();
            $table->string('route');
            $table->string('provider');
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
        Schema::dropIfExists('messages');
    }
};
