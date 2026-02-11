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
    Schema::table('home_settings', function (Blueprint $table) {
        $table->string('contact_instagram')->nullable()->after('contact_email');
        $table->string('contact_whatsapp')->nullable()->after('contact_instagram');
    });
}

public function down()
{
    Schema::table('home_settings', function (Blueprint $table) {
        $table->dropColumn(['contact_instagram', 'contact_whatsapp']);
    });
}
};
