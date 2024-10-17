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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Tạo cột id tự động tăng, là khóa chính
            $table->string('name', 100)->unique()->nullable(false); // Tên không rỗng và không trùng nhau
            $table->integer('status'); // Cột status kiểu số
            $table->date('created_at')->default(DB::raw('CURRENT_DATE')); // Ngày tạo mặc định là ngày hiện tại
            $table->timestamp('updated_at')->useCurrent(); // Timestamp mặc định là ngày hiện tại
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
