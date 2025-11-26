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
        Schema::create('riwayat', function (Blueprint $table) {
            $table->integer('riwayat_id', true);
            $table->integer('antrian_id')->index('antrian_id');
            $table->integer('mekanik_id')->nullable()->index('mekanik_id');
            $table->integer('user_id')->index('user_id');
            $table->integer('bengkel_id')->nullable()->index('fk_riwayat_bengkel');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->decimal('total_biaya', 10)->nullable();
            $table->text('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat');
    }
};
