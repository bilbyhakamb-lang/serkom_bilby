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
        Schema::create('beritas', function (Blueprint $table) {
                $table->integer('id_berita', true);
                $table->string('judul', 50);
                $table->text('isi');
                $table->date('tanggal');
                $table->string('gambar', 100);
                
                $table->integer('id_user'); 
                $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
                
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
