<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('order_items')) {
            return;
        }

        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('variant_id');

            $table->unsignedBigInteger('store_line_item_id');
            $table->unsignedBigInteger('store_product_id')->nullable();
            $table->unsignedBigInteger('store_variant_id')->nullable();
            $table->unsignedBigInteger('store_fulfillment_id')->nullable();
            $table->string('admin_graphql_api_id', 64)->nullable();

            $table->string('name', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('variant_title', 255)->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 8, 2)->default(0.00);
            $table->text('price_set')->nullable();
            $table->decimal('total_discount', 8, 2)->default(0.00);
            $table->text('total_discount_set')->nullable();
            $table->text('discount_allocations')->nullable();
            $table->boolean('gift_card')->nullable();
            $table->integer('grams')->default(0);
            $table->string('sku', 255)->nullable();
            $table->string('vendor', 255)->nullable();
            $table->text('properties')->nullable();
            $table->boolean('taxable')->default(1);
            $table->text('tax_lines')->nullable();
            $table->boolean('requires_shipping')->default(1);
            $table->boolean('product_exists')->default(1);

            $table->string('fulfillment_service', 255)->nullable();
            $table->string('fulfillment_status', 255)->nullable();
            $table->integer('fulfillable_quantity')->default(1);
            $table->timestamp('fulfilled_at')->nullable();

            $table->string('variant_inventory_management', 255)->nullable();
            $table->text('origin_location')->nullable();

            $table->timestamp('synced_at')->nullable();

            $table->softDeletes();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
