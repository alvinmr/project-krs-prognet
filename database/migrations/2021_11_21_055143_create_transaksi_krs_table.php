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
        Schema::create('TransaksiKrs', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_ajaran');
            $table->string('semester');
            $table->enum('nilai', ['A', 'B+', 'B', 'C+', 'C', 'D+', 'D', 'E']);
            $table->enum('status', ['disetujui', 'ditolak', 'pending']);
            $table->unsignedSmallInteger('matakuliah_id');
            $table->unsignedInteger('mahasiswa_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TransaksiKrs');
    }
}
