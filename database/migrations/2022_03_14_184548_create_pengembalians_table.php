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
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->foreignId("dokumen_id")->constrained("dokumen")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade")->onUpdate("cascade");
            $table->date('tgl_kembali');
            $table->date('tgl_pengembalian');            
            $table->integer('denda');                         
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
        Schema::dropIfExists('pengembalian');
    }
};
