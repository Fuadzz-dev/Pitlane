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
        Schema::create('bengkel', function (Blueprint $table) {
            $table->integer('bengkel_id', true);
            $table->string('nama_bengkel', 100);
            $table->text('alamat');
            $table->string('no_hp', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('jam_operasional', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bengkel');
    }
};
