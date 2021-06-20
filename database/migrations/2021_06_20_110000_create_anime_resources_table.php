<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anime_resources', function (Blueprint $table) {
            $table->string('id', 24)->primary();
            $table->enum('type', ['tv', 'stream', 'theater'])->comment('Type of the resource');
            $table->integer('mal_id')->comment('MAL ID');
            $table->string('platform_id', 24);
            $table->boolean('paid')->comment('Defines if the resource requires payment');
            $table->string('link')->nullable()->comment('Link to the resource');
            $table->string('note')->nullable()->comment('Note of the resource');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('platform_id')->references('id')->on('anime_platforms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime_availabilities');
    }
}
