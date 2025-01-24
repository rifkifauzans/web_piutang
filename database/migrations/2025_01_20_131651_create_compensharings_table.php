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
        Schema::create('compensharing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->year('tahun');
            $table->integer('pendapatan_mitra'); 
            $table->integer('kompensasi_sharing');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compensharings');
    }
};
