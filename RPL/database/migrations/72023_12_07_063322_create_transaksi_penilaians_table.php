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
        Schema::create('transaksi_penilaians', function (Blueprint $table) {
            $table->id();
            $table->string('integritas');
            $table->string('handal');
            $table->string('tangguh');
            $table->string('kolaborasi');
            $table->string('inovasi');
            $table->string('penilai_id')->index();
            $table->string('kritik_saran');

            // Ensure that the data type and length match the 'Nim' column in 'penguruses'
            $table->string('pengurus_id', 10)->nullable();

            // Add an index on the foreign key column
            $table->index('pengurus_id');

            $table->foreign('pengurus_id')->references('Nim')->on('penguruses')->onDelete('set null');
            $table->integer('Status');
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
        Schema::dropIfExists('transaksi_penilaians');
    }
};