<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_affiliates', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->unsignedInteger('unique_id')->nullable();
            $table->integer('contact_id');
            $table->string('name', 255);
            $table->integer('client_id')->nullable();
            $table->integer('status')->default(0);
            $table->unsignedInteger('language_id')->nullable();


            $table->dateTime('created_on')->default('CURRENT_TIMESTAMP');
            $table->unsignedInteger('created_by')->nullable();
            $table->dateTime('modified_on')->nullable();
            $table->unsignedInteger('modified_by')->nullable();
            $table->dateTime('deleted_on')->nullable();
            $table->unsignedInteger('deleted_by')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('core_affiliates');
    }
};
