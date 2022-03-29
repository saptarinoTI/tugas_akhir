<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJudulToProposaltaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proposalta', function (Blueprint $table) {
            $table->text('judul_satu')->after('file_tiga')->nullable();
            $table->text('judul_dua')->after('judul_satu')->nullable();
            $table->text('judul_tiga')->after('judul_dua')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proposalta', function (Blueprint $table) {
            $table->dropColumn('judul_satu');
            $table->dropColumn('judul_dua');
            $table->dropColumn('judul_tiga');
        });
    }
}
