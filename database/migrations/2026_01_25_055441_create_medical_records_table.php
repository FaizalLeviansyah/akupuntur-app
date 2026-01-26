<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');

            $table->text('keluhan_utama');
            $table->text('keluhan_tambahan')->nullable();
            $table->text('riwayat_penyakit_sekarang')->nullable();
            $table->text('riwayat_penyakit_dahulu')->nullable();

            $table->string('shen_kesadaran')->nullable();
            $table->string('shen_cahaya_mata')->nullable();
            $table->string('shen_mimik_muka')->nullable();
            $table->string('warna_wajah')->nullable();
            $table->string('postur_tubuh')->nullable();

            $table->string('lidah_warna')->nullable();
            $table->string('lidah_bentuk')->nullable();
            $table->string('lidah_gerak')->nullable();
            $table->string('lidah_selaput_warna')->nullable();
            $table->string('lidah_selaput_tebal')->nullable();

            $table->json('nadi_kanan')->nullable();
            $table->json('nadi_kiri')->nullable();

            $table->text('diagnosis_penyakit')->nullable();
            $table->text('diagnosis_sindrom')->nullable();
            $table->text('penyebab_penyakit')->nullable();

            $table->text('metode_terapi')->nullable();
            $table->text('titik_akupuntur')->nullable();
            $table->text('saran_anjuran')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
