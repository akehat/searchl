<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_statistics', function (Blueprint $table) {
            $table->id();
            $table->integer('provider_id');
            $table->integer('search_count'); // todo: search count per term (separate table)
            $table->integer('top_ten');
            $table->integer('calls_attempted');
            $table->integer('jobs');
            $table->integer('profile_view');
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
        Schema::dropIfExists('provider_statistics');
    }
}
