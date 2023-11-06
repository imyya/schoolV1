<?php

use App\Models\Cours;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cours_profs', function (Blueprint $table) {
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
