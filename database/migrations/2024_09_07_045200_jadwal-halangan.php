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
        Schema::create('jadwal_halangan', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key with auto increment
            $table->string('id_pendeta')->nullable();
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('keterangan');
            $table->enum('status', ['ACTIVE', 'EXPIRED'])->default('EXPIRED');
            $table->timestamps();
            $table->foreign('id_pendeta')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            Schema::dropIfExists('jadwal_halangan');
    }
};
