<?php

use App\Models\Bed;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocatedBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocated_beds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('bed_id');
            $table->unsignedBigInteger('people_id');
            $table->string('people_type');
            $table->string('referrer_user')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->date('start_at');
            $table->date('expired_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('place_id')->on('places')->references('id');
            $table->foreign('room_id')->on('rooms')->references('id');
            $table->foreign('bed_id')->on('beds')->references('id');
            $table->foreign('people_id')->on('people')->references('id');
            $table->foreign('created_by')->on('users')->references('id');

            $table->index(['id', 'place_id', 'room_id', 'bed_id', 'people_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allocated_beds');
    }
}
