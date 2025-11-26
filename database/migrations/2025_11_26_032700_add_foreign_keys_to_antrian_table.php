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
        Schema::table('antrian', function (Blueprint $table) {
            $table->foreign(['layanan_id'], 'antrian_ibfk_3')->references(['layanan_id'])->on('layanan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['bengkel_id'], 'fk_antrian_bengkel')->references(['bengkel_id'])->on('bengkel')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['user_id'], 'fk_antrian_user')->references(['user_id'])->on('user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('antrian', function (Blueprint $table) {
            $table->dropForeign('antrian_ibfk_3');
            $table->dropForeign('fk_antrian_bengkel');
            $table->dropForeign('fk_antrian_user');
        });
    }
};
