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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nama');
            $table->enum('role', ['Admin TU', 'Guru', 'Kepala Sekolah'])->default('Guru');
            $table->integer('no_hp')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('perguruan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('password');
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
