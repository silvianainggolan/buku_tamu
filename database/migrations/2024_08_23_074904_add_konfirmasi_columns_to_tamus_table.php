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
        Schema::table('tamus', function (Blueprint $table) {
            //
            $table->date('tanggal_konfirmasi')->nullable();
            $table->time('waktu_konfirmasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            //
            $table->dropColumn('tanggal_konfirmasi');
            $table->dropColumn('waktu_konfirmasi');
        });
    }
};
