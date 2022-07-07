<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id');
            $table->double('longitude');
            $table->double('latitude');
            $table->integer('range');
            $table->string('range_format'); // e.g. km
            $table->string('search_string')->nullable(); // what's this for?
            $table->string('is_available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_statuses');
    }
}
