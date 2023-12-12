<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penguruses', function (Blueprint $table) {
            $table->string('Nim')->primary();
            $table->string('Nama');
            $table->foreignId('organisasi_id')->nullable()->constrained();
            $table->foreignId('divisi_id')->nullable()->constrained();
            $table->foreignId('jabatan_id')->nullable()->constrained();
            $table->foreignId('program_studi_id')->nullable()->constrained();
            $table->string('Password');
            $table->integer('Status');
            $table->string('modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penguruses');
    }
};
