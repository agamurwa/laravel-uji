<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_dokter');
            $table->string('no_telp');
            $table->longText('alamat');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('bidang');
            $table->longText('tentang_dokter');
            $table->longText('riwayat_pendidikan');
            $table->longText('riwayat_pekerjaan');
            $table->longText('organisasi');
            $table->softDeletes();
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
        Schema::dropIfExists('doctors');
    }
}
