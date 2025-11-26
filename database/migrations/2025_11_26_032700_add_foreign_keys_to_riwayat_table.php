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
        Schema::table('riwayat', function (Blueprint $table) {
            $table->foreign(['bengkel_id'], 'fk_riwayat_bengkel')->references(['bengkel_id'])->on('bengkel')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['antrian_id'], 'riwayat_ibfk_1')->references(['antrian_id'])->on('antrian')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['mekanik_id'], 'riwayat_ibfk_2')->references(['mekanik_id'])->on('mekanik')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['user_id'], 'riwayat_ibfk_3')->references(['user_id'])->on('user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat', function (Blueprint $table) {
            $table->dropForeign('fk_riwayat_bengkel');
            $table->dropForeign('riwayat_ibfk_1');
            $table->dropForeign('riwayat_ibfk_2');
            $table->dropForeign('riwayat_ibfk_3');
        });
    }
};
