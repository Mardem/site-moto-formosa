<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('rfc');
            $table->longText('description');
            $table->mediumText('seo_description');
            $table->mediumText('keywords');
            $table->double('price');
            $table->double('promotional_price')->nullable();
            $table->integer('local')->default(array_search('DEFAULT', \App\Models\Admin\Product\Product::LOCAL));
            $table->integer('qtd')->default(1);

            $table->string('ml_link')->nullable();
            $table->string('ml_link_edit')->nullable();

            // Dados para cálculo do frete
            $table->double('width');
            $table->double('height');
            $table->double('length');
            $table->double('weight');

            $table->unsignedBigInteger('category_product_id');
            $table->foreign('category_product_id')->references('id')->on('category_products');
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
