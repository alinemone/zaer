<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servants', function (Blueprint $table) {
            $table->id();
            $table->string('name_family');
            $table->string('national_code')->nullable()->unique();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->default('1');
            $table->string('workplace')->nullable();
            $table->string('quota')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->tinyInteger('degree')->nullable();
            $table->string('job')->nullable();
            $table->text('how_to')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->date('start_at')->nullable();
            $table->date('expired_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'national_code', 'mobile']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servants');
    }
}
