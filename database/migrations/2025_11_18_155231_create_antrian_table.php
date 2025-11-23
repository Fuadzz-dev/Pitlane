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
        Schema::create('antrian', function (Blueprint $table) {
            $table->integer('antrian_id', true);
            $table->integer('user_id')->index('user_id');
            $table->integer('layanan_id')->index('layanan_id');
            $table->integer('admin_id')->nullable()->index('admin_id');
            $table->integer('bengkel_id')->nullable()->index('fk_antrian_bengkel');
            $table->string('tipe', 100);
            $table->string('plat', 20);
            $table->dateTime('tanggal_pemesanan')->nullable()->useCurrent();
            $table->dateTime('tanggal_servis');
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'batal'])->nullable()->default('menunggu');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrian');
    }
};
