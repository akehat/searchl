<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_logs', function (Blueprint $table) {
            $table->id();
            $table->string('search_string');
            $table->tinyInteger('emergency')->default(0);
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();

            $table->integer('range')->default(10);
            $table->string('range_format')->default('KM'); // e.g. KM / MI

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
        Schema::dropIfExists('search_logs');
    }
}
