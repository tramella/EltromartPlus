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
            $table->id();
            $table->string("product_name");
            $table->unsignedBigInteger("cate_id");
            $table->unsignedBigInteger("brand_id");
            $table->unsignedBigInteger("color_id");
            $table->string('product_img');
            $table->decimal('regular_price');
            $table->decimal('sale_price')->nullable();
            $table->integer('quantity');
            $table->string('materials')->nullable();
            $table->string('type')->nullable();
            $table->string('storage')->nullable();
            $table->string('RAM')->nullable();
            $table->integer('quantity_sold')->nullable();
            $table->string('status')->default('active');
            $table->text('descriptions')->nullable();
            $table->string('refresh_rate')->nullable();
            $table->string('screen_size')->nullable();
            $table->string('port')->nullable();
            $table->string('weight')->nullable();
            $table->string('screen_resolution')->nullable();
            $table->string('graphics_card')->nullable();
            $table->string('CPU')->nullable();
            $table->string('Wired')->nullable();
            $table->string('Wiredless')->nullable();
            $table->string('Gaming')->nullable();
            $table->string('DPI')->nullable();
            $table->string('Silent')->nullable();
            $table->string('length')->nullable();
            $table->string('featured')->nullable();
            $table->timestamps();
            // Tạo khóa ngoại
            $table->foreign('cate_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');
            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onDelete('cascade');
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
