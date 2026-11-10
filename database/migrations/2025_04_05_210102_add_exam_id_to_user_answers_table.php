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
            $table->unsignedBigInteger('exam_id')->nullable(); // إضافة العمود
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade'); // ربطه بجدول الامتحانات
        });
    }
    
    public function down()
    {
        Schema::table('user_answers', function (Blueprint $table) {
            $table->dropColumn('exam_id'); // حذف العمود إذا تم التراجع
        });
    }
    
};
