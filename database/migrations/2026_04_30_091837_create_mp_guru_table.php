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
        Schema::create('mp_guru', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained()->cascadeOnDelete();
            $table->foreignId('mp_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['guru_id', 'mp_id']); // prevent duplicate pairs
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mp_guru');
    }
};
