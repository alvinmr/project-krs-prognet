<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiKrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_krs', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_ajaran');
            $table->string('semester');
            $table->enum('nilai', ['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E']);
            $table->enum('status', ['disetujui', 'ditolak', 'pending']);
            $table->foreignId('matakuliah_id')->constrained('matakuliah');
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
        Schema::dropIfExists('transaksi_krs');
    }
}