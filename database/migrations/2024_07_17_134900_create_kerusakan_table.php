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
        Schema::create('kerusakan', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->date('tanggal');
            // $table->integer('jumlah');
            // $table->text('keterangan');
            $table->json('sarana');
            // $table->string('sarana_id', 50);
            // $table->foreign('sarana_id')->references('id')->on('sarana')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerusakan');
    }
};
