<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Schema::create('units', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('author_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->string('name', 48)->unique();
        //     $table->string('code', 3)->unique();
        //     $table->enum('status', ['published', 'unpublished', 'deleted'])->default('unpublished');
        //     $table->timestamps(6);
        // });

        // Schema::create('brands', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('ref_id', 20)->unique();
        //     $table->foreignId('author_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->string('name', 48)->unique();
        //     $table->string('keywords', 255);
        //     $table->string('description', 155);
        //     $table->string('logo', 255);
        //     $table->enum('status', ['published', 'unpublished', 'deleted'])->default('unpublished');
        //     $table->timestamps(6);
        // });

        // Schema::create('categories', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('ref_id', 20)->unique();
        //     $table->foreignId('author_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->string('name', 48)->unique();
        //     $table->string('keywords', 255);
        //     $table->string('description', 155);
        //     $table->string('thumbnail', 255);
        //     $table->enum('status', ['published', 'unpublished', 'deleted'])->default('unpublished');
        //     $table->timestamps();
        // });

        // Schema::create('sub_categories', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('ref_id', 20)->unique();
        //     $table->foreignId('author_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->string('name', 48)->unique();
        //     $table->string('keywords', 255);
        //     $table->string('description', 155);
        //     $table->string('thumbnail', 255);
        //     $table->enum('status', ['published', 'unpublished', 'deleted'])->default('unpublished');
        //     $table->timestamps(6);
        // });

        // Schema::create('sub_categories_brands', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('category_id')->constrained('sub_categories')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete()->cascadeOnUpdate();
        // });

        // Schema::create('products', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('ref_id', 20)->unique();
        //     $table->foreignId('author_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->foreignId('sub_category_id')->constrained('sub_categories')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->string('name', 125);
        //     $table->string('keywords', 255);
        //     $table->string('short_description', 155);
        //     $table->foreignId('unit_id')->nullable()->constrained('units')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->integer('quantity')->nullable();
        //     $table->integer('stock')->nullable();
        //     $table->double('discount', 8, 2)->nullable();
        //     $table->double('price', 8, 2)->nullable();
        //     $table->text('content')->nullable();
        //     $table->string('thumbnail', 255)->nullable();
        //     $table->enum('type', ['new', 'out_of_stock', 'special', 'best_selling', 'top_rated', 'offer'])->default('new');
        //     $table->enum('status', ['published', 'unpublished', 'deleted'])->default('unpublished');
        //     $table->integer('views')->default(0);
        //     $table->integer('likes')->default(0);
        //     $table->integer('dislikes')->default(0);
        //     $table->integer('orders')->default(0);
        //     $table->double('ratings', 1, 2)->default(0.00);
        //     $table->integer('delivered')->default(0);
        //     $table->integer('rejected')->default(0);
        //     $table->timestamps(6);
        // });

        // Schema::create('product_images', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->string('path', 255);
        // });

        // Schema::create('product_colors', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->string('name', 48);
        //     $table->string('primary', 7);
        //     $table->string('secondary', 7)->nullable();
        // });

        // Schema::create('product_color_images', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
        //     $table->string('name', 48);
        //     $table->string('path', 255);
        // });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['active', 'deleted'])->default('active');
            $table->timestamps();
        });

        Schema::create('wishlist_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['active', 'deleted'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('units');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('sub_categories');
        Schema::dropIfExists('sub_categories_brands');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_colors');
        Schema::dropIfExists('product_color_images');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('wishlist_items');
    }
};
