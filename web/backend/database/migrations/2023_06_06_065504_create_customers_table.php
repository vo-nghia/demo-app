<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('customers')) {
            return;
        }

        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('store_type')->default(addslashes(\Dan\Shopify\Laravel\Models\Store::class));
            $table->unsignedInteger('store_id')->nullable();
            $table->unsignedInteger('last_order_id')->nullable();

            $table->unsignedBigInteger('store_customer_id')->nullable();
            $table->unsignedBigInteger('store_last_order_id')->nullable();
            $table->string('admin_graphql_api_id', 64)->nullable();

            $table->string('email', 255)->nullable();
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('company', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('address1', 255)->nullable();
            $table->string('address2', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('zip', 255)->nullable();
            $table->string('province_code', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('country_name', 255)->nullable();
            $table->string('locale')->nullable();
            $table->tinyInteger('accepts_marketing')->nullable();
            $table->text('note')->nullable();

            $table->text('tags')->nullable();
            $table->text('default_address')->nullable();

            $table->string('currency', 4)->nullable();
            $table->integer('orders_count')->nullable();
            $table->decimal('total_spent', 10, 2)->nullable();
            $table->string('last_order_name', 19)->nullable();
            $table->boolean('tax_exempt')->nullable();
            $table->boolean('verified_email')->nullable();
            $table->string('multipass_identifier')->nullable();

            $table->timestamp('store_created_at')->nullable();
            $table->timestamp('store_updated_at')->nullable();

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
        Schema::dropIfExists('customers');
    }
}
