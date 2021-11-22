<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatakuliahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Matakuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama_matakuliah');
            $table->string('semester');
            $table->enum('status_matakuliah', ['Wajib','Pilihan', 'Merdeka Belajar']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->unsignedSmallInteger('dosen_id');
            $table->unsignedSmallInteger('prodi_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Matakuliah');
    }
}
