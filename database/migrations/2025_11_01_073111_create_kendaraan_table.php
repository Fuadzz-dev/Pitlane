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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->integer('kendaraan_id', true);
            $table->integer('user_id')->index('user_id');
            $table->string('plat_nomor', 20)->unique('plat_nomor');
            $table->string('merk', 50)->nullable();
            $table->string('model', 50)->nullable();
            $table->integer('tahun')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
