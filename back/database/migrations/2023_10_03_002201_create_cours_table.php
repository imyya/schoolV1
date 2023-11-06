<?php

use App\Models\Module;
use App\Models\Semestre;
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
        Schema::dropIfExists('cours');
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Module::class)->constrained();
            $table->foreignIdFor(Semestre::class)->constrained();
            $table->foreignId("professeur_id")->constrained("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
