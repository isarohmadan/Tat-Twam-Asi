<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom is_admin
            $table->dropColumn('is_admin');
            
            // Tambahkan kolom role
            $table->enum('role', ['admin', 'ketua_yayasan', 'user'])->default('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan perubahan dengan menambahkan kolom is_admin
            $table->boolean('is_admin')->default(false);
            
            // Hapus kolom role
            $table->dropColumn('role');
        });
    }
}
