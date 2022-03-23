<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name_family');
            $table->string('national_code')->nullable()->unique();
            $table->string('mobile')->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->default('1');
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->tinyInteger('degree')->nullable();
            $table->string('job')->nullable();
            $table->text('how_to')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
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
        Schema::dropIfExists('people');
    }
}
