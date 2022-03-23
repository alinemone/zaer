<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->string('bed_number');
            $table->unsignedBigInteger('room_id');
            $table->boolean('assigned');
            $table->boolean('is_active');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('room_id')->on('rooms')->references('id');

            $table->index(['id','bed_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beds');
    }
}
