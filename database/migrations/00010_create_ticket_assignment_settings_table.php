<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(config('ticket.assignment_settings', 'ticket_assignment_settings'), function (Blueprint $table) {
            $table->id();
            $table->enum('entity_type', config('ticket.entities'))->index();
            $table->unsignedInteger('language_id')->index();
            $table->unsignedInteger('user_id')->index();

            $table->unique(['entity_type', 'language_id', 'user_id']);

            $table->foreign('user_id')->references('id')->on('core_users');
            $table->foreign('language_id')->references('id')->on('crypto_languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(config('ticket.assignment_settings', 'ticket_assignment_settings'));
    }
};
