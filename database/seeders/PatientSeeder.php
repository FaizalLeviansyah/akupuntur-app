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
            $table->text('main_complaint');
            $table->text('additional_complaint')->nullable();
            $table->json('tongue_observation')->nullable();
            $table->json('pulse_observation')->nullable();
            $table->text('diagnosis_syndrome')->nullable();
            $table->text('therapy_points')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
