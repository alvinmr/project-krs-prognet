<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTahunAjaranIdToTransaksiKrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi_krs', function (Blueprint $table) {
            $table->foreignId('tahun_ajaran_id')->default(1)->constrained('tahun_ajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi_krs', function (Blueprint $table) {
            $table->dropColumn('tahun_ajaran_id');
        });
    }
}