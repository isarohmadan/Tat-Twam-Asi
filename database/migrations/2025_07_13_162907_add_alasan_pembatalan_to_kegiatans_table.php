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
    Schema::table('kegiatans', function (Blueprint $table) {
        $table->string('status_pembatalan')->nullable();
        $table->text('alasan_pembatalan')->nullable()->after('status_pembatalan');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            //
        });
    }
};
