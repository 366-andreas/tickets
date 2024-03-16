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
        Schema::create(config('ticket.feedback', 'ticket_feedback'), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ticket_id')->index();
            $table->binary('feedback')->nullable()->index();
            $table->unsignedInteger('feedback_reviewed_by_user_id')->nullable()->index();

            $table->timestamp('feedback_reviewed_on')->nullable()->index();
            $table->timestamp(config('ticket.timestamps.created', 'created_on'))->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp(config('ticket.timestamps.updated', 'modified_on'))->nullable()->useCurrentOnUpdate();
            $table->integer('modified_by');
            $table->timestamp(config('ticket.timestamps.deleted', 'deleted_on'))->nullable()->useCurrentOnUpdate();
            $table->integer('deleted_by')->nullable();

            $table->foreign('ticket_id')->references('id')->on(config('tickets.tickets', 'tickets'));
            $table->foreign('feedback_reviewed_by_user_id')->references('id')->on('core_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(config('ticket.feedback', 'ticket_feedback'));
    }
};
