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
            $table->id('id_product');
            $table->foreignId('id_producer')->constrained('producers', 'id_producer');
            $table->foreignId('id_category')->constrained('categories', 'id_category');
            $table->foreignId('id_subcategory')->constrained('subcategories', 'id_subcategory');
            $table->foreignId('id_seller')->constrained('sellers', 'id_seller');
            $table->string('name');
            $table->longText('description');
            $table->float('price');
            $table->integer('amount');
            $table->timestamps();
            $table->softDeletes();
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
