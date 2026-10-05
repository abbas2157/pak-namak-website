<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->string('tiktok')->nullable()->after('facebook');
            $table->string('twitter')->nullable()->after('linkedin');
            $table->string('youtube')->nullable()->after('twitter');
            $table->string('whatsapp')->nullable()->after('youtube');
        });
    }

    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn(['tiktok', 'twitter', 'youtube', 'whatsapp']);
        });
    }
};
