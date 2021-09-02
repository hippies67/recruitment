<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('kelas');
            $table->string('prodi');
            $table->string('semester');
            $table->string('divisi');
            $table->text('pengetahuan_divisi');
            $table->text('pengalaman_divisi')->nullable();
            $table->text('pengalaman_organisasi');
            $table->string('kesanggupan_menjadi_pengurus');
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
        Schema::dropIfExists('recruitments');
    }
}
