<?php

use App\Models\SessionCours;
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
        Schema::create('demande_annulations', function (Blueprint $table) {
            $table->id();
            $table->string('motif');
            $table->enum('etat',['validé','annulé','en_attente']);
            $table->foreignIdFor(SessionCours::class)->constrained();
            $table->foreignId('professeur_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_annulations');
    }
};
