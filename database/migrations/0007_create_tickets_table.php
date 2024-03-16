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
        Schema::create(config('ticket.table', 'tickets'), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->enum('entity_type', config('ticket.entities'))->index();
            $table->integer('entity_id')->index();
            $table->unsignedInteger('assignee')->nullable()->index();
            $table->unsignedInteger('language_id')->index();

            $table->string('subject')->nullable()->index();

            $table->enum('status', ['pending', 'new', 'open', 'reopen', 'closed'])->default('open');
            $table->enum('priority', ['low', 'normal', 'high', 'critical'])->index()->default('low');
            $table->enum('opened_by', ['entity', 'user'])->index()->default('user');
            $table->enum('waiting_response_from', ['entity', 'user'])->index()->default('user');

            $table->timestamp(config('ticket.timestamps.created', 'created_on'))->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp(config('ticket.timestamps.updated', 'modified_on'))->nullable()->useCurrentOnUpdate();
            $table->integer('modified_by')->nullable();
            $table->timestamp(config('ticket.timestamps.deleted', 'deleted_on'))->nullable()->useCurrentOnUpdate();
            $table->integer('deleted_by')->nullable();

            $table->foreign('assignee')->references('id')->on('core_users');
            $table->foreign('category_id')->references('id')->on('ticket_categories');
            $table->foreign('language_id')->references('id')->on('crypto_languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(config('ticket.table', 'tickets'));
    }
};
