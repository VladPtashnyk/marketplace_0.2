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
        Schema::rename('comments', 'reviews');
        Schema::table('reviews', function (Blueprint $table) {
            $table->renameColumn('id_comment', 'id_review');
            $table->integer('status')->default(1)->comment('1 = new, 2 = accepted')->after('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('reviews', 'status');
        Schema::rename('reviews', 'comments');
    }
};
