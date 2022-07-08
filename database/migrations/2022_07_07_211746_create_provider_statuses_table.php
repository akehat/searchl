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
            $table->string('is_available')->default('green');
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();

            // the following 2 columns are not for the MVP. Currently, the client searches within a range.
            // In future releases, we can give the ability to search according to providers range relative to client's location
            $table->integer('range')->default(10);
            $table->string('range_format')->default('KM'); // e.g. km

            $table->string('search_string')->nullable(); // what's this for?

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
