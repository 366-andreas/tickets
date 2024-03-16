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
        Schema::create(config('ticket.category', 'ticket_categories'), function (Blueprint $table) {
            $table->id();
            $table->string('system_name');
            $table->enum('entity_type', config('ticket.entities'))->index();
            $table->boolean('enabled')->default(false);
            $table->string('color')->nullable()->index();
            $table->enum('priority', config('ticket.priorities'))->index();

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
        Schema::dropIfExists(config('ticket.category', 'ticket_categories'));
    }
};
