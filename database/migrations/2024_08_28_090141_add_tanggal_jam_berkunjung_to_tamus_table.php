<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->date('tanggal_berkunjung')
            ->after('keperluan');
            $table->time('jam_berkunjung')->nullable()->after('tanggal_berkunjung');
        });
        
    }
    
    public function down()
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->dropColumn(['tanggal_berkunjung', 'jam_berkunjung']);
        });
    }
    
};
