<?php

use App\Models\Place;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('place_id');
            $table->integer('floor');
            $table->boolean('is_active');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('place_id')->on('places')->references('id');

            $table->index(['id', 'place_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
