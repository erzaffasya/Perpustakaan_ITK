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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->foreignId("kategori_id")->constrained("kategori")->onDelete("cascade")->onUpdate("cascade");
            $table->string('tahun_terbit')->nullable();
            $table->string('nama_pengarang')->nullable();
            $table->string('penerbit')->nullable();
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade")->onUpdate("cascade");
            $table->string('cover')->nullable();
            $table->string('abstract_en')->nullable();
            $table->string('abstact_id')->nullable();
            $table->string('bab1')->nullable();
            $table->string('bab2')->nullable();
            $table->string('bab3')->nullable();
            $table->string('bab4')->nullable();
            $table->string('kesimpulan')->nullable();
            $table->string('daftar_pustaka')->nullable();
            $table->string('paper')->nullable();
            $table->string('lembar_persetujuan')->nullable();
            $table->string('full_dokumen')->nullable();
            $table->longtext('data_tambahan')->nullable();
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
        Schema::dropIfExists('dokumen');
    }
};
