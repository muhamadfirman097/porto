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
    Schema::create('home_settings', function (Blueprint $table) {
        $table->id();
        $table->string('site_name')->default('MyPortfolio');
        $table->string('hero_title')->default('Halo, Saya Web Developer');
        $table->text('hero_description')->nullable();
        $table->string('profile_image')->nullable();
        $table->string('contact_email')->nullable();
        $table->string('contact_linkedin')->nullable();
        $table->string('contact_github')->nullable();
        
        // PERBAIKAN: Hapus ->default(...)
        $table->text('footer_text'); 
        
        $table->string('primary_color')->default('#4f46e5');
        $table->string('font_family')->default('sans');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_settings');
    }
};
