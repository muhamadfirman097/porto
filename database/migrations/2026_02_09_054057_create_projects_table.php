<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');          // Nama Project
            $table->string('image');          // Foto Project
            $table->text('description');      // Deskripsi Project
            $table->string('tech_stack');     // Bahasa yg dipakai (Misal: "Laravel, React, Tailwind")
            $table->string('demo_url')->nullable();   // Link Live (Vercel/Hosting) - Boleh kosong
            $table->string('source_url')->nullable(); // Link Source Code (Github) - Boleh kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
