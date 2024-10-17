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
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->string('name', 100)->nullable(false); // Tên không được rỗng
            $table->string('email', 100)->unique()->nullable(false); // Email không trùng nhau và không được rỗng
            $table->string('password', 100)->nullable(false); // Mật khẩu không được rỗng
            $table->string('phone', 50)->unique()->nullable(false); // Số điện thoại không trùng và không được rỗng
            $table->string('address', 250)->nullable(); // Địa chỉ có thể rỗng
            $table->date('created_at')->default(DB::raw('CURRENT_DATE')); // Ngày tạo mặc định là ngày hiện tại
            $table->timestamp('updated_at')->useCurrent(); // Ngày cập nhật mặc định là ngày hiện tại
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
