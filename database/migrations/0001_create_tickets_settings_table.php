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
        Schema::create(config('ticket.settings', 'ticket_settings'), function (Blueprint $table) {
            $table->id();
            $table->enum('entity_type', config('ticket.entities'))->index();
            $table->integer('inactive_days_passed_to_resolve_ticket')->nullable()->index();
            $table->boolean('ai_status')->default(false)->index();

            $table->timestamp(config('ticket.timestamps.created', 'created_on'))->useCurrent();
            $table->integer('created_by')->nullable();
            $table->timestamp(config('ticket.timestamps.updated', 'modified_on'))->nullable()->useCurrentOnUpdate();
            $table->integer('modified_by')->nullable();
            $table->timestamp(config('ticket.timestamps.deleted', 'deleted_on'))->nullable()->useCurrentOnUpdate();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(config('ticket.settings', 'ticket_settings'));
    }
};
