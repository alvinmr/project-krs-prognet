<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khs', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->string('tahun_ajaran');
            $table->string('semester');
            $table->string('kode_matkul');
            $table->string('nama_matkul');
            $table->string('jumlah_sks');
            $table->string('nilai_huruf');
            $table->unsignedFloat('nilai_bobot');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('khs');
    }
}
