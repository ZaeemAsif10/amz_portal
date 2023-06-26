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
            $table->string('product_no')->nullable();
            $table->string('cate_id')->nullable();
            $table->string('keyword')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('amz_seller')->nullable();
            $table->string('market')->nullable();
            $table->string('chi_seller')->nullable();
            $table->string('prod_type')->nullable();
            $table->string('amz_image')->nullable();
            $table->string('image')->nullable();
            $table->string('commission')->nullable();
            $table->string('day_sale')->nullable();
            $table->string('all_sale')->nullable();
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
