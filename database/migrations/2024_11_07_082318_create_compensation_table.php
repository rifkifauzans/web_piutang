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
        Schema::create('compensation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->year('tahun');           
            $table->date('jatuh_tempo');         
            $table->integer('nilai_kompensansi');     
            $table->integer('ppn');                    
            $table->integer('nilai_plus_ppn'); 
            $table->integer('pbb');                    
            $table->integer('lainnya')->nullable();    
            $table->integer('total'); 
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
        Schema::dropIfExists('compensation');
    }
};
