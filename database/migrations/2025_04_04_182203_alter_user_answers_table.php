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
            // السماح للعمود user_id بالقيمة null
            $table->integer('user_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('user_answers', function (Blueprint $table) {
            // إرجاع العمود ليكون غير قابل للقيمة null
            $table->integer('user_id')->nullable(false)->change();
        });
    }
};
