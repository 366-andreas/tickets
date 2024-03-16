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
        Schema::create(config('ticket.reply_templates_content', 'ticket_reply_templates_content'), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('template_id')->index();
            $table->text('content')->nullable()->index();
            $table->unsignedInteger('language_id')->index();

            $table->foreign('template_id')->references('id')->on(config('ticket.reply_templates', 'ticket_reply_templates'));
            $table->foreign('language_id')->references('id')->on('crypto_languages');

            $table->unique(['template_id', 'language_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(config('ticket.reply_templates_content', 'ticket_reply_templates_content'));
    }
};
