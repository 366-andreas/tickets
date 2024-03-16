<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(config('ticket.attachments.table', 'ticket_attachments'), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id')->index();
            $table->unsignedBigInteger('response_id')->index()->nullable();
            $table->string('attachment_name');
            $table->string('attachment_name_original');
            $table->tinyInteger('is_encrypted')->default(0)->nullable();
            $table->timestamp(config('ticket.timestamps.created', 'created_at'))->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp(config('ticket.timestamps.updated', 'updated_at'))->nullable()->useCurrentOnUpdate();
            $table->integer('modified_by')->nullable();

            $table->timestamp(config('ticket.timestamps.deleted', 'deleted_on'))->nullable()->useCurrentOnUpdate();
            $table->integer('deleted_by')->nullable();

            $table->foreign('ticket_id')->references('id')->on(config('ticket.table', 'tickets'))->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('response_id')->references('id')->on(config('ticket.responses.table', 'ticket_responses'))->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('ticket.attachments.table', 'ticket_attachments'));
    }
};
