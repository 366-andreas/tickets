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
        Schema::create(config('ticket.category_content', 'ticket_categories_content'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('category_id')->index();
            $table->unsignedInteger('language_id')->index();

            $table->foreign('category_id')->references('id')->on(config('ticket.category', 'ticket_categories'));
            $table->foreign('language_id')->references('id')->on('crypto_languages');

            $table->unique(['category_id', 'language_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(config('ticket.category_content', 'ticket_categories_content'));
    }
};
