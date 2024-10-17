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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->unsignedBigInteger('customer_id')->nullable(false); // Khóa ngoại đến bảng customers
            $table->text('content')->nullable(false); // Nội dung không được rỗng
            $table->tinyInteger('status')->default(0); // Trạng thái mặc định là 0
            $table->date('created_at')->default(DB::raw('CURRENT_DATE')); // Ngày tạo mặc định là ngày hiện tại
            $table->timestamp('updated_at')->useCurrent(); // Ngày cập nhật mặc định là ngày hiện tại

            // Tạo khóa ngoại liên kết với bảng customers
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
