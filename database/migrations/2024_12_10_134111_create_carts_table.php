<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('cartable_type');
            $table->unsignedBigInteger('cartable_id');
            $table->timestamps();
            
            $table->index(['cartable_type', 'cartable_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
