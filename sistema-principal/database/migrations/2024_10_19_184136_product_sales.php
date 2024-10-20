<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('sale_id');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->softDeletes();
            $table->timestamps();

            // Relacionamento com a tabela products
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // Relacionamento com a tabela sales
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_sales', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['sale_id']);
        });
        Schema::dropIfExists('product_sales');
    }
}