<?php

use App\Models\Cours;
use App\Models\Classe;
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
        Schema::create('cours_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Classe::class)->constrained();
            $table->foreignIdFor(Cours::class)->constrained();
            $table->integer("heures");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours_classes');
    }
};
