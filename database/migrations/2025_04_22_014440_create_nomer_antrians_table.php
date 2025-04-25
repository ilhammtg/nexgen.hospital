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
        Schema::create('nomer_antrian', function (Blueprint $table) {
            $table->id();
            $table->char('id_pasien', 36);
            $table->date('tanggal');
            $table->enum('status', ['menunggu', 'dilayani', 'selesai'], 'default', 'menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomer_antrians');
    }
};
