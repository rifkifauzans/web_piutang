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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_code')->unique();
            $table->unsignedBigInteger('partner_id');
            $table->unsignedBigInteger('field_id');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('employee_id');
            $table->date('awal_janji');
            $table->date('akhir_janji'); 
            $table->integer('nilai');
            $table->string('no_pks');
            $table->integer('jangka_waktu');
            $table->integer('luas');
            $table->string('ket');
            $table->enum('status', ['Baru', 'Progress (Surat Izin)', 'Berakhir']);
            $table->softDeletes();
            $table->timestamps();

            // Menambahkan foreign key constraint pada partner_id
            $table->foreign('partner_id')->references('user_id')->on('partners')->onDelete('cascade');
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};

