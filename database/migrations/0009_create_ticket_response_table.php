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
        Schema::create(config('ticket.responses', 'ticket_responses'), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id')->index();
            $table->unsignedBigInteger('entity_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->mediumText('message');
            $table->enum('type', ['external', 'internal'])->default('external');
            $table->timestamp(config('ticket.timestamps.created', 'created_on'))->useCurrent();
            $table->integer('created_by')->nullable()->comment('if ticket is created by user then its the user_id otherwise is null');
            $table->timestamp(config('ticket.timestamps.updated', 'modified_on'))->nullable()->useCurrentOnUpdate();
            $table->integer('modified_by')->nullable()->comment('if ticket is updated by user then its the user_id otherwise is null');
            $table->timestamp(config('ticket.timestamps.deleted', 'deleted_on'))->nullable()->useCurrentOnUpdate();
            $table->integer('deleted_by')->nullable()->comment('if ticket is updated by user then its the user_id otherwise is null');

            $table->foreign('ticket_id')->references('id')->on(config('ticket.table', 'tickets'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(config('ticket.responses', 'ticket_responses'));
    }
};
