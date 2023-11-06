<?php

use App\Models\Salle;
use App\Models\CoursClasse;
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
        Schema::create('session_cours', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('hd');
            $table->time('hf');
            $table->time('duree');
            $table->foreignId("attache_id")->constrained("users")->nullable();
            $table->foreignIdFor(CoursClasse::class)->constrained()->nullable();
            $table->foreignIdFor(Salle::class)->constrained()->nullable();
            $table->enum('etat', ['valide','invalide'])->default('valide');
            $table->enum('mode',['presentiel','en_ligne']);});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_cours');
    }
};
