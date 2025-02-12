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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compensation_id'); 
            $table->unsignedBigInteger('contract_id'); 
            $table->date('tgl_terbit');
            $table->enum('status', ['draft', 'kirim']); 
            $table->integer('jml_denda')->default(0); 
            $table->enum('status_sp', ['None', 'SP1', 'SP2', 'SP3']); 
            $table->integer('total_tagihan');
            $table->integer('jml_bayar')->default(0);  
            $table->integer('sisa_tagihan')->default(0);
            $table->softDeletes();
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('compensation_id')->references('id')->on('compensation')->onDelete('cascade');
            $table->foreign('contract_id')->references('id')->on('contracts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
