<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('faqs', function (Blueprint $table) {
        $table->string('question')->nullable()->after('id'); // Izinkan NULL dulu
    });

    // Set nilai default untuk data yang sudah ada
    DB::statement("UPDATE faqs SET question = 'Pertanyaan default' WHERE question IS NULL");

    Schema::table('faqs', function (Blueprint $table) {
        $table->string('question')->nullable(false)->change(); // Setelah ada nilai, ubah jadi NOT NULL
    });
}

};
