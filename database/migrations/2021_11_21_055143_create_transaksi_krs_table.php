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
            $table->enum('nilai', ['Tunda', 'A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E'])->default('Tunda');
            $table->enum('status', ['disetujui', 'ditolak', 'pending']);
            $table->foreignId('matakuliah_id')->constrained('matakuliah');
            $table->foreignUuid('mahasiswa_id')->constrained('mahasiswa');
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