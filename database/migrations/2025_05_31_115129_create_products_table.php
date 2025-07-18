<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
    $table->string('name');
    $table->unsignedBigInteger('category_id'); // внешний ключ
    $table->float('price');
    $table->text('description');
    $table->timestamps();

    $table->foreign('category_id')
          ->references('id')
          ->on('categories')
          ->onDelete('cascade');
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
};
