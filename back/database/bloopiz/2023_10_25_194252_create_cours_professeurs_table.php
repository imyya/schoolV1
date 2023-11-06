<?php

use App\Models\Cours;
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
        Schema::create('cours_professeurs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cours::class);
            $table->foreignId("professeur_id")->constrained("users");
            $table->integer("nbre_total_heure");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours_profs');
    }
};
