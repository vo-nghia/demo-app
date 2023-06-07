<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('orders')) {
            return;
        }

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('customer_id');

            $table->string('store_type')->default(addslashes(config('shopify.stores.model')));
            $table->integer('store_id');

            $table->unsignedBigInteger('store_order_id');
            $table->unsignedBigInteger('store_customer_id')->nullable();
            $table->unsignedBigInteger('store_user_id')->nullable();
            $table->unsignedBigInteger('store_app_id')->nullable();
            $table->string('admin_graphql_api_id', 64)->nullable();

            $table->string('number', 19)->nullable();
            $table->string('name', 20)->nullable();

            $table->boolean('test')->default(false);

            $table->string('email', 255)->nullable();
            $table->string('contact_email', 255)->nullable();

            $table->string('checkout_id', 19)->nullable();
            $table->string('checkout_token', 32)->nullable();
            $table->string('cart_token', 32)->nullable();

            $table->string('token', 32)->nullable();

            $table->string('order_status_url', 255)->nullable();

            $table->text('shipping_address')->nullable();
            $table->string('shipping_first_name', 64)->nullable();
            $table->string('shipping_last_name', 128)->nullable();
            $table->string('shipping_name', 128)->nullable();
            $table->string('shipping_phone', 32)->nullable();
            $table->string('shipping_company', 128)->nullable();
            $table->string('shipping_address1', 128)->nullable();
            $table->string('shipping_address2', 128)->nullable();
            $table->string('shipping_city', 255)->nullable();
            $table->string('shipping_province', 64)->nullable();
            $table->string('shipping_province_code', 6)->nullable();
            $table->string('shipping_zip', 32)->nullable();
            $table->string('shipping_country', 64)->nullable();
            $table->string('shipping_country_code', 2)->nullable();
            $table->string('shipping_latitude', 32)->nullable();
            $table->string('shipping_longitude', 32)->nullable();

            $table->text('billing_address')->nullable();
            $table->string('billing_first_name', 64)->nullable();
            $table->string('billing_last_name', 128)->nullable();
            $table->string('billing_name', 128)->nullable();
            $table->string('billing_phone', 32)->nullable();
            $table->string('billing_company', 128)->nullable();
            $table->string('billing_address1', 128)->nullable();
            $table->string('billing_address2', 128)->nullable();
            $table->string('billing_city', 255)->nullable();
            $table->string('billing_province', 64)->nullable();
            $table->string('billing_province_code', 6)->nullable();
            $table->string('billing_zip', 32)->nullable();
            $table->string('billing_country', 64)->nullable();
            $table->string('billing_country_code', 2)->nullable();
            $table->string('billing_latitude', 32)->nullable();
            $table->string('billing_longitude', 32)->nullable();

            $table->string('phone', 32)->nullable();

            $table->decimal('total_price', 8, 2)->default(0);
            $table->decimal('total_line_items_price', 8, 2)->default(0);
            $table->decimal('total_price_usd', 8, 2)->default(0);
            $table->decimal('subtotal_price', 8, 2)->default(0);
            $table->decimal('total_tax', 8, 2)->default(0);
            $table->decimal('total_discounts', 8, 2)->default(0);
            $table->integer('total_weight')->nullable(); // grams
            $table->text('discount_codes')->nullable();
            $table->text('discount_applications')->nullable();
            $table->string('credit_card_number_last4', 4)->nullable();
            $table->string('credit_card_company', 32)->nullable();
            $table->text('tax_lines')->nullable();
            $table->boolean('tax_included')->nullable();
            $table->decimal('total_tip_received', 8, 2)->default(0);

            $table->string('presentment_currency')->default('USD');
            $table->text('subtotal_price_set')->nullable();
            $table->text('total_discounts_set')->nullable();
            $table->text('total_line_items_price_set')->nullable();
            $table->text('total_price_set')->nullable();
            $table->text('total_shipping_price_set')->nullable();
            $table->text('total_tax_set')->nullable();

            $table->string('store_location_id', 19)->nullable();
            $table->string('gateway', 32)->nullable();
            $table->text('payment_details')->nullable();
            $table->string('payment_gateway_names')->nullable();
            $table->string('processing_method', 32)->nullable();

            $table->boolean('confirmed')->nullable();
            $table->string('financial_status', 32)->nullable();
            $table->string('fulfillment_status', 16)->nullable();
            $table->text('fulfillments')->nullable();
            $table->text('refunds')->nullable();
            $table->string('cancel_reason', 16)->nullable();

            $table->string('source_identifier', 32)->nullable();
            $table->string('source_name', 64)->nullable();
            $table->string('source_url', 255)->nullable();
            $table->string('tags', 255)->nullable();

            $table->text('client_details')->nullable();
            $table->string('client_details_browser_ip', 32)->nullable();
            $table->string('client_details_accept_language', 255)->nullable();
            $table->text('client_details_user_agent')->nullable();
            $table->string('client_details_session_hash', 255)->nullable();
            $table->unsignedMediumInteger('client_details_browser_width')->nullable();
            $table->unsignedMediumInteger('client_details_browser_height')->nullable();

            $table->string('device_id', 64)->nullable();
            $table->boolean('buyer_accepts_marketing')->nullable();

            $table->string('reference', 32)->nullable();
            $table->text('referring_site')->nullable();
            $table->text('landing_site')->nullable();
            $table->text('landing_site_ref')->nullable();

            $table->text('note', 255)->nullable();
            $table->text('note_attributes')->nullable();

            $table->string('webhook_error', 255)->nullable();
            $table->timestamp('webhook_error_at')->nullable();

            $table->timestamp('fulfilled_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('store_created_at')->nullable();
            $table->timestamp('store_updated_at')->nullable();

            $table->timestamp('synced_at')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('orders');
    }
}
