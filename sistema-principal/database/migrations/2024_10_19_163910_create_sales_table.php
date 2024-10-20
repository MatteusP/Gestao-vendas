<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('product_id'); // ID do produto
            $table->integer('quantity'); // Quantidade vendida
            $table->decimal('total_price', 10, 2); // Preço total da venda
            $table->string('customer_name'); // Nome do cliente
            $table->string('customer_cpf'); // CPF do cliente
            $table->string('customer_phone'); // Telefone do cliente
            $table->string('customer_email'); // Email do cliente
            $table->string('coupon_code')->nullable(); // Código do cupom (opcional)
            $table->unsignedBigInteger('user_id');
            $table->string('status')->default('pending');
            $table->timestamps(); // Campos de data de criação e atualização

            // Relacionamento com a tabela users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
