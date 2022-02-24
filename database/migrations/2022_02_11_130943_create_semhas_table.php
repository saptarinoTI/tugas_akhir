<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semhas', function (Blueprint $table) {
            $table->bigInteger('id')->unique()->primary();
            $table->bigInteger('proposalta_id')->unique()->nullable()->references('id')->on('proposalta')->onDelete('cascade');
            $table->string('mahasiswa_nim')->unique()->nullable()->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->string('krs', 70);
            $table->string('transkip_nilai', 70);
            $table->string('laporan_kp', 70);
            $table->string('kartu_kuning', 70);
            $table->string('sk_keuangan', 70);
            $table->string('lmbr_konsultasi', 70);
            $table->text('judul_ta');
            $table->enum('status', ['dikirim', 'diterima', 'ditolak', 'selesai'])->default('dikirim');
            $table->date('tgl_acc')->nullable();
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
        Schema::dropIfExists('semhas');
    }
}
