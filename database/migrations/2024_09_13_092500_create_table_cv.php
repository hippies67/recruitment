<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->string('fileName');
            $table->timestamps();

            $table->foreign('user')->references('id')->on('recruitment_users')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cv');
    }
}
