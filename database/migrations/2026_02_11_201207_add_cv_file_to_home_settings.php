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
        // Menambahkan kolom cv_file yang hanya menerima PDF
        $table->string('cv_file')->nullable()->after('profile_image');
    });
}

public function down()
{
    Schema::table('home_settings', function (Blueprint $table) {
        $table->dropColumn('cv_file');
    });
}
};
