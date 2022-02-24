<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendadaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendadaran', function (Blueprint $table) {
            $table->bigInteger('id')->unique()->primary();
            $table->bigInteger('proposalta_id')->unique()->nullable()->references('id')->on('proposalta')->onDelete('cascade');
            $table->string('mahasiswa_nim')->unique()->nullable()->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->string('krs', 70);
            $table->string('transkip_nilai', 70);
            $table->string('lmbr_konsultasi', 70);
            $table->string('bebas_perkuliahan', 70);
            $table->string('bebas_keuangan', 70);
            $table->string('bebas_perpus', 70);
            $table->string('bebas_lab', 70);
            $table->string('act_program', 70);
            $table->string('komp_lab', 70);
            $table->string('toefl', 70);
            $table->string('ijazah_terakhir', 70);
            $table->string('ktp', 70);
            $table->string('akte_kelahiran', 70);
            $table->string('foto', 70);
            $table->enum('status', ['dikirim', 'lulus', 'diterima', 'ditolak', 'tidak_lulus'])->default('dikirim');
            $table->date('tgl_lulus')->nullable();
            $table->text('judul_ta')->nullable();
            $table->text('keterangan');
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
        Schema::dropIfExists('pendadaran');
    }
}
