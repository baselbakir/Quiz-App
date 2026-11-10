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
        Schema::table('user_answers', function (Blueprint $table) {
            // إزالة القيد الخاص بالمفتاح الخارجي
            $table->dropForeign(['user_id']);
        });
    }
    
    public function down()
    {
        Schema::table('user_answers', function (Blueprint $table) {
            // إعادة إضافة القيد الخاص بالمفتاح الخارجي
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
};
