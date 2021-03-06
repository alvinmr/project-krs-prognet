<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nim');
            $table->string('nama');
            $table->string('alamat');
            $table->string('telepon');
            $table->enum('angkatan', ['2017', '2018', '2019', '2020', '2021']);
            $table->string('foto_mahasiswa');
            $table->string('password');
            $table->foreignId('prodi_id')->constrained('prodi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}