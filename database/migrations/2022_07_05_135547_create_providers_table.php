<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();

            $table->string('profession_type'); //free text for now
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('base_location');
            $table->string('phone_number');
            $table->string('search_fields');
            $table->string('standard_work_hours');
            $table->tinyInteger('emergency_availability');
            $table->tinyInteger('share_exact_location'); // or only the proximity to the user
            $table->string('website_url')->nullable();
            $table->string('linkedin')->nullable();
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
        Schema::dropIfExists('providers');
    }
}
