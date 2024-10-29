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
        Schema::create('keluar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('masuk_id');
            $table->foreign('masuk_id')->references('id')->on('masuk')->onDelete('cascade');
            $table->dateTime('tanggal');
            $table->text('keterangan');
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluar');
    }
};
