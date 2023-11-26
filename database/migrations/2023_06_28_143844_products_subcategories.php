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
        Schema::create('products_subcategories', function (Blueprint $table) {
            $table->id('id_product_subcategory');
            $table->foreignId('id_subcategory')->constrained('subcategories', 'id_subcategory');
            $table->foreignId('id_product')->constrained('products', 'id_product');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_subcategories');
    }
};
