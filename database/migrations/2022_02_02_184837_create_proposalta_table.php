<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposaltaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposalta', function (Blueprint $table) {
            $table->bigInteger('id')->unique()->primary();
            $table->bigInteger('mahasiswa_nim')->unique()->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->string('file_satu', 150)->nullable();
            $table->string('file_dua', 150)->nullable();
            $table->string('file_tiga', 150)->nullable();
            $table->text('judul_satu')->nullable();
            $table->text('judul_dua')->nullable();
            $table->text('judul_tiga')->nullable();
            $table->date('tgl_acc')->nullable();
            $table->bigInteger('dosen_id_satu')->nullable()->references('id')->on('dosen')->onDelete('cascade');
            $table->bigInteger('dosen_id_dua')->nullable()->references('id')->on('dosen')->onDelete('cascade');
            $table->text('judul_ta')->nullable();
            $table->enum('status', ['dikirim', 'diterima', 'ditolak', 'selesai'])->default('dikirim');
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
        Schema::dropIfExists('proposalta');
    }
}
