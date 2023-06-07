<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('stores')) {
            return;
        }

        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedBigInteger('store_primary_location_id')->nullable();
            $table->string('name', 255);
            $table->string('shop_owner', 255);
            $table->string('email', 255);
            $table->string('customer_email', 255)->nullable();
            $table->string('domain', 255)->nullable();
            $table->string('myshopify_domain', 255);
            $table->string('address1', 128)->nullable();
            $table->string('address2', 128)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('province', 32)->nullable();
            $table->string('province_code', 8)->nullable();
            $table->string('country', 2)->nullable();
            $table->string('country_code', 64)->nullable();
            $table->string('country_name', 64)->nullable();
            $table->string('source', 255)->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('latitude', 32)->nullable();
            $table->string('longitude', 32)->nullable();
            $table->string('primary_locale', 8)->nullable();
            $table->string('timezone', 64)->nullable();
            $table->string('iana_timezone', 32)->nullable();
            $table->string('currency', 4)->nullable();
            $table->string('money_format', 128)->nullable();
            $table->string('money_in_emails_format', 128)->nullable();
            $table->string('money_with_currency_in_emails_format', 128)->nullable();
            $table->string('money_with_currency_format', 128)->nullable();
            $table->string('weight_unit', 2)->nullable();
            $table->string('plan_name', 32)->nullable();
            $table->string('plan_display_name', 16)->nullable();
            $table->boolean('has_discounts')->nullable();
            $table->boolean('has_gift_cards')->nullable();
            $table->boolean('has_storefront')->nullable();
            $table->string('google_apps_domain', 255)->nullable();
            $table->boolean('google_apps_login_enabled')->nullable();
            $table->boolean('eligible_for_payments')->nullable();
            $table->boolean('eligible_for_card_reader_giveaway')->nullable();
            $table->boolean('finances')->nullable();
            $table->boolean('checkout_api_supported')->nullable();
            $table->boolean('multi_location_enabled')->nullable();
            $table->boolean('force_ssl')->nullable();
            $table->boolean('pre_launch_enabled')->nullable();
            $table->boolean('requires_extra_payments_agreement')->nullable();
            $table->boolean('password_enabled')->nullable();
            $table->text('enabled_presentment_currencies')->nullable();
            $table->boolean('taxes_included')->nullable();
            $table->boolean('tax_shipping')->nullable();
            $table->boolean('county_taxes')->nullable();
            $table->boolean('setup_required')->nullable();
            $table->timestamp('store_created_at')->nullable();
            $table->timestamp('store_updated_at')->nullable();

            $table->unsignedInteger('order_count')->default(0);
            $table->unsignedInteger('product_count')->default(0);
            $table->unsignedInteger('customer_count')->default(0);

            $table->string('token', 255)->nullable();
            $table->text('scopes')->nullable();
            $table->text('webhooks')->nullable();
            $table->string('uninstall_code', 4)->nullable();

            $table->timestamp('uninstalled_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('last_webhook_at')->nullable();
            $table->timestamp('last_call_at')->nullable();
            $table->timestamp('last_customer_import_at')->nullable();
            $table->timestamp('last_product_import_at')->nullable();
            $table->timestamp('last_order_import_at')->nullable();
            $table->timestamp('last_customer_update_at')->nullable();
            $table->timestamp('last_product_update_at')->nullable();
            $table->timestamp('last_order_update_at')->nullable();
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
        Schema::dropIfExists('stores');
    }
}
