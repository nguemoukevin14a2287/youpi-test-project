<?php

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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poste_id')->constrained();
            $table->string('matricule', 20)->unique();
            $table->char('sexe');
            $table->string('name', 200);
            $table->datetime('birthday')->nullable();
            $table->string('address', 250)->nullable();
            $table->datetime('joined_at');
            $table->integer('salary')->default('0');
            $table->string('image', 200)->nullable();
            $table->text('strengths')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
