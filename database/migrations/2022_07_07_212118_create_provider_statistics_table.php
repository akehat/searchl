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
            $table->integer('search_count')->default(0); // todo: search count per term (separate table)
            $table->integer('top_ten')->default(0);
            $table->integer('calls_attempted')->default(0);
            $table->integer('jobs')->default(0);
            $table->integer('profile_view')->default(0);
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
