<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('orderable_type');
            $table->unsignedBigInteger('orderable_id');
            $table->dateTime('ordered_date');
            $table->dateTime('delivery_date');
            $table->decimal('unit_price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total_amount', 10, 2);
            $table->timestamps();

            $table->index(['orderable_type', 'orderable_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
