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
    Schema::create('guru_mengajar', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')
              ->constrained('users')
              ->cascadeOnDelete();
        $table->foreignId('kelas_id')
              ->constrained('kelas')
              ->cascadeOnDelete();
        $table->foreignId('mp_id')
              ->constrained('mps')
              ->cascadeOnDelete();
        $table->timestamps();

        // A teacher can only teach the same subject in the same class once
        $table->unique(['user_id', 'kelas_id', 'mp_id']);
    });
}

public function down(): void
{
    Schema::dropIfExists('guru_mengajar');
}
};
