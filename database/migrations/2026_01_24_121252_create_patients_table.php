<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('name');
            $table->integer('age');
            $table->enum('gender', ['L', 'P']);
            $table->string('religion')->nullable();
            $table->string('job')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->float('bmi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
