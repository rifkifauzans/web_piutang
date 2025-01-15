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
            $table->date('tgl_terbit');
            $table->date('jatuh_tempo');
            $table->integer('nilai_tagihan');
            $table->enum('status', ['draft', 'kirim', 'lunas', 'bayar sebagian', 'lewat waktu']);
            $table->integer('jml_denda')->default(0);
            $table->enum('status_sp', ['None', 'SP1', 'SP2', 'SP3']);
            $table->integer('sp')->default(0);
            $table->softDeletes();
            $table->timestamps();

            // Menambahkan foreign key constraint pada compensation_id
            $table->foreign('compensation_id')->references('id')->on('compensation')->onDelete('cascade');
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
