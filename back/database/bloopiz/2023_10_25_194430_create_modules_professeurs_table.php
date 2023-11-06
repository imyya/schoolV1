<?php

use App\Models\Module;
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
        Schema::create('modules_professeurs', function (Blueprint $table) {
            $table->id();
            $table->integer("heures");
            $table->foreignId("professeur_id")->constrained("users");
            $table->foreignIdFor(Module::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules_profs');
    }
};
