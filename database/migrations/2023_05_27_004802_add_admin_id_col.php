<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminIdCol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blocked_users', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('admin_id')->after('client_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade'); 
            $table->dropForeign('blocked_users_stadium_id_foreign');
            $table->dropColumn('stadium_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blocked_users', function (Blueprint $table) {
            //
        });
    }
}
