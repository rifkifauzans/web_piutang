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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->string('bukti_bayar')->nullable();
            $table->date('tgl_bayar')->nullable();
            $table->integer('jml_bayar');
            $table->enum('status', ['belum dibayar', 'sudah dibayar', 'bayar sebagian', 'lewat waktu']);
            $table->string('ket')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Menambahkan foreign key constraint pada invoice_id
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
