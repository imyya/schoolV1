<?php

use App\Models\Salle;
use App\Models\Classe;
use App\Models\SessionCours;
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
        Schema::create('classe_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Classe::class)->constrained();
            $table->foreignIdFor(SessionCours::class)->constrained();
            $table->foreignIdFor(Salle::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_sessions');
    }
};
