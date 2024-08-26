<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPegawaiIdToTamusTable extends Migration
{
    public function up()
    {
        Schema::table('tamus', function (Blueprint $table) {
            // Tambahkan kolom pegawai_id jika belum ada
            if (!Schema::hasColumn('tamus', 'pegawai_id')) {
                $table->unsignedBigInteger('pegawai_id')->nullable()->after('pesan');
                $table->foreign('pegawai_id')->references('id')->on('pegawai')->onDelete('set null');
            }
        });
    }

    public function down()
    {
        Schema::table('tamus', function (Blueprint $table) {
            // Hapus foreign key dan kolom pegawai_id jika diperlukan
            $table->dropForeign(['pegawai_id']);
            $table->dropColumn('pegawai_id');
        });
    }
}
