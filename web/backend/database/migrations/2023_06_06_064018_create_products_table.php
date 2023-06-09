<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('products')) {
            return;
        }

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('store_product_id');
            $table->string('title', 255)->nullable();
            $table->text('body_html')->nullable();
            $table->string('vendor', 128)->nullable();
            $table->string('status', 32)->nullable();
            $table->string('product_type', 255)->nullable();
            $table->string('handle', 255)->nullable();
            $table->string('template_suffix', 32)->nullable();
            $table->string('published_scope', 16)->nullable();
            $table->text('tags')->nullable();
            $table->text('options')->nullable();
            $table->text('images')->nullable();
            $table->text('image')->nullable();

            $table->timestamp('published_at')->nullable();

            $table->timestamp('store_created_at')->nullable();
            $table->timestamp('store_updated_at')->nullable();

            $table->string('admin_graphql_api_id', 64)->nullable();

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
        Schema::dropIfExists('products');
    }
}
