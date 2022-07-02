<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id('id');
            $table->string('id_pasien');
            $table->string('nama_pasien');
            $table->integer('doctors_id');
            $table->string('nama_dokter');
            $table->longText('keluhan');
            $table->longText('anamnesis');
            $table->longText('pemeriksaan_fisik');
            $table->string('diagnosa');
            $table->text('id_obat');
            $table->text('jumlah_obat');
            $table->text('aturan_minum');
            $table->date('tgl_periksa');
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
        Schema::dropIfExists('medical_records');
    }
}
