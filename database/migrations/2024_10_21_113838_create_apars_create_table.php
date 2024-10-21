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
        Schema::create('apars', function (Blueprint $table) {
            $table->id();
            $table->string('jenis');
            $table->string('merek');
            $table->string(column: 'no_apar');
            $table->date('tangal_exp');
            $table->string('perawatan');
            $table->string('keterangan');
            // $table->foreign('gedung_id')->references('id')->on('gedungs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apars');
    }
};
