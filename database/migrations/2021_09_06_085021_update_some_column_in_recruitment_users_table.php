<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSomeColumnInRecruitmentUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recruitment_users', function (Blueprint $table) {
            $table->text('pengalaman_divisi')->nullable()->after('program_studi')->change();
            $table->boolean('email_sent')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruitment_users', function (Blueprint $table) {
            //
        });
    }
}
