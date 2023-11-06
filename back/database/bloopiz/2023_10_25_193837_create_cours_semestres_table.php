<?php

use App\Models\Cours;
use App\Models\Semestre;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cours_semestres', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cours::class);
            $table->foreignIdFor(Semestre::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours_semestres');
    }
};