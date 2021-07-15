<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('sub_category_two_id')->nullable();
            $table->foreignId('sub_category_three_id')->nullable();
            $table->foreignId('brand_id');
            $table->string('title')->unique();
            $table->double('price');
            $table->string('image');
            $table->string('remark');
            $table->string('review')->nullable();
            $table->integer('product_code');
            $table->enum('available', [1, 2])->default(1);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('sort_desc', 200);
            $table->text('desc');
            $table->string('slug');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
