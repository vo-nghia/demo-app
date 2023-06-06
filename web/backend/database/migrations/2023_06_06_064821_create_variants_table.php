<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('variants')) {
            return;
        }

        Schema::create('variants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->string('title', 255)->nullable();
            $table->decimal('price', 8, 2)->default(0.00);
            $table->string('sku', 255)->nullable();
            $table->integer('position')->default(1);
            $table->string('inventory_policy')->nullable();
            $table->decimal('compare_at_price', 8, 2)->nullable()->default(0.00);
            $table->string('inventory_management', 255)->nullable();

            $table->string('option1', 255)->nullable();
            $table->string('option2', 255)->nullable();
            $table->string('option3', 255)->nullable();

            $table->timestamp('store_created_at')->nullable();
            $table->timestamp('store_updated_at')->nullable();

            $table->tinyInteger('taxable')->default(1);
            $table->string('barcode', 255)->nullable();
            $table->integer('grams')->default(0);
            $table->unsignedBigInteger('store_image_id')->nullable();
            $table->string('weight', 255)->nullable();
            $table->string('weight_unit', 255)->nullable();
            $table->string('inventory_item_id')->nullable();
            $table->integer('inventory_quantity')->nullable();
            $table->integer('old_inventory_quantity')->nullable();
            $table->boolean('requires_shipping')->nullable();
            $table->string('admin_graphql_api_id', 64)->nullable();

            $table->unsignedBigInteger('store_variant_id');
            $table->unsignedBigInteger('store_product_id');

            $table->timestamp('synced_at')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variants');
    }
}
