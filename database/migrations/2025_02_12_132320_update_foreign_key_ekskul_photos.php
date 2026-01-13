<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('ekskul_photos', function (Blueprint $table) {
            // Hapus foreign key lama
            $table->dropForeign(['ekskul_id']);

            // Tambahkan foreign key baru TANPA cascade delete
            $table->foreign('ekskul_id')->references('id')->on('ekskuls')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::table('ekskul_photos', function (Blueprint $table) {
            // Hapus foreign key baru
            $table->dropForeign(['ekskul_id']);

            // Kembalikan ke onDelete('cascade')
            $table->foreign('ekskul_id')->references('id')->on('ekskuls')->onDelete('cascade');
        });
    }
};

