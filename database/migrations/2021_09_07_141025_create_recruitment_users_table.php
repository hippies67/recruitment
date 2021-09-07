<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recruitment');
            $table->foreign('recruitment')->references('id')->on('recruitments');
            $table->string('nama_lengkap');
            $table->unsignedBigInteger('kelas');
            $table->foreign('kelas')->references('id')->on('classes');
            $table->unsignedBigInteger('program_studi');
            $table->foreign('program_studi')->references('id')->on('study_programs');
            $table->unsignedBigInteger('semester');
            $table->foreign('semester')->references('id')->on('semesters');
            $table->string('email');
            $table->unsignedBigInteger('divisi');
            $table->foreign('divisi')->references('id')->on('divisions');
            $table->text('pengetahuan_divisi');
            $table->text('pengalaman_divisi')->nullable();
            $table->text('pengalaman_organisasi');
            $table->enum('minat_menjadi_pengurus', ['ya', 'tidak', 'mungkin']);
            $table->enum('status', ['proses', 'terima', 'tolak']);
            $table->boolean('email_sent')->default(0);
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
        Schema::dropIfExists('recruitment_users');
    }
}
