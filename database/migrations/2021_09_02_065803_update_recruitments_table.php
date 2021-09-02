<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recruitments', function (Blueprint $table) {
            $table->dropColumn('nama_lengkap');
            $table->dropColumn('kelas');
            $table->dropColumn('prodi');
            $table->dropColumn('semester');
            $table->dropColumn('divisi');
            $table->dropColumn('pengetahuan_divisi');
            $table->dropColumn('pengalaman_divisi')->nullable();
            $table->dropColumn('pengalaman_organisasi');
            $table->dropColumn('kesanggupan_menjadi_pengurus');
            $table->integer('tahun')->after('id');
            $table->text('selayang_pandang')->after('tahun');
            $table->string('banner')->after('selayang_pandang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
