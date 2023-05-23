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
        Schema::create('lives', function (Blueprint $table)
        {
            $table->unsignedBigInteger('product_id')->primary();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('like')->default(0);

            $table->integer('view')->default(0);

            $table->tinyInteger('hidden')->default(0);

            $table->timestamps();

            $table->index('hidden');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lives');
    }
};
