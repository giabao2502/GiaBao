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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->string('name', 120)->nullable(false); // Tên không được rỗng
            $table->float('price')->nullable(false); // Giá không được rỗng
            $table->float('sale_price')->default(0); // Giá giảm, mặc định là 0, cho phép rỗng
            $table->string('image', 200)->nullable(false); // Hình ảnh, không được rỗng
            $table->unsignedBigInteger('category_id')->nullable(false); // Khóa ngoại đến bảng categories
            $table->tinyInteger('status')->default(1); // Trạng thái, mặc định là 1, cho phép rỗng
            $table->text('content')->nullable(false); // Nội dung, không được rỗng
            $table->date('created_at')->default(DB::raw('CURRENT_DATE')); // Ngày tạo, mặc định là ngày hiện tại
            $table->timestamp('updated_at')->useCurrent(); // Ngày cập nhật, mặc định ngày hiện tại

            // Tạo khóa ngoại liên kết với bảng categories
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
