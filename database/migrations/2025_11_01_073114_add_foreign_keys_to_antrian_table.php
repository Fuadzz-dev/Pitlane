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
            $table->foreign(['user_id'], 'antrian_ibfk_1')->references(['user_id'])->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['kendaraan_id'], 'antrian_ibfk_2')->references(['kendaraan_id'])->on('kendaraan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['layanan_id'], 'antrian_ibfk_3')->references(['layanan_id'])->on('layanan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['admin_id'], 'antrian_ibfk_4')->references(['admin_id'])->on('admin')->onUpdate('cascade')->onDelete('set null');
            $table->foreign(['bengkel_id'], 'fk_antrian_bengkel')->references(['bengkel_id'])->on('bengkel')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('antrian', function (Blueprint $table) {
            $table->dropForeign('antrian_ibfk_1');
            $table->dropForeign('antrian_ibfk_2');
            $table->dropForeign('antrian_ibfk_3');
            $table->dropForeign('antrian_ibfk_4');
            $table->dropForeign('fk_antrian_bengkel');
        });
    }
};
