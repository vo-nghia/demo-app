<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class WebhookEventTopic extends Enum
{
    public const APP_UNINSTALLED = 'app/uninstalled';

    public const BULK_OPERATIONS_FINISH = 'bulk_operations/finish';

    public const CARTS_CREATE = 'carts/create';

    public const CARTS_UPDATE = 'carts/update';

    public const CHECKOUTS_CREATE = 'checkouts/create';

    public const CHECKOUTS_DELETE = 'checkouts/delete';

    public const CHECKOUTS_UPDATE = 'checkouts/update';

    public const COLLECTION_LISTINGS_ADD = 'collection_listings/add';

    public const COLLECTION_LISTINGS_REMOVE = 'collection_listings/remove';

    public const COLLECTION_LISTINGS_UPDATE = 'collection_listings/update';

    public const COLLECTIONS_CREATE = 'collections/create';

    public const COLLECTIONS_DELETE = 'collections/delete';

    public const COLLECTIONS_UPDATE = 'collections/update';

    public const CUSTOMER_GROUPS_CREATE = 'customer_groups/create';

    public const CUSTOMER_GROUPS_DELETE = 'customer_groups/delete';

    public const CUSTOMER_GROUPS_UPDATE = 'customer_groups/update';

    public const CUSTOMER_PAYMENT_METHODS_CREATE = 'customer_payment_methods/create';

    public const CUSTOMER_PAYMENT_METHODS_REVOKE = 'customer_payment_methods/revoke';

    public const CUSTOMER_PAYMENT_METHODS_UPDATE = 'customer_payment_methods/update';

    public const CUSTOMERS_MARKETING_CONSENT_UPDATE = 'customers_marketing_consent/update';

    public const CUSTOMERS_CREATE = 'customers/create';

    public const CUSTOMERS_DELETE = 'customers/delete';

    public const CUSTOMERS_DISABLE = 'customers/disable';

    public const CUSTOMERS_ENABLE = 'customers/enable';

    public const CUSTOMERS_UPDATE = 'customers/update';

    public const DISPUTES_CREATE = 'disputes/create';

    public const DISPUTES_UPDATE = 'disputes/update';

    public const DOMAINS_CREATE = 'domains/create';

    public const DOMAINS_DESTROY = 'domains/destroy';

    public const DOMAINS_UPDATE = 'domains/update';

    public const DRAFT_ORDERS_CREATE = 'draft_orders/create';

    public const DRAFT_ORDERS_DELETE = 'draft_orders/delete';

    public const DRAFT_ORDERS_UPDATE = 'draft_orders/update';

    public const FULFILLMENT_EVENTS_CREATE = 'fulfillment_events/create';

    public const FULFILLMENT_EVENTS_DELETE = 'fulfillment_events/delete';

    public const FULFILLMENTS_CREATE = 'fulfillments/create';

    public const FULFILLMENTS_UPDATE = 'fulfillments/update';

    public const INVENTORY_ITEMS_CREATE = 'inventory_items/create';

    public const INVENTORY_ITEMS_DELETE = 'inventory_items/delete';

    public const INVENTORY_ITEMS_UPDATE = 'inventory_items/update';

    public const INVENTORY_LEVELS_CONNECT = 'inventory_levels/connect';

    public const INVENTORY_LEVELS_DISCONNECT = 'inventory_levels/disconnect';

    public const INVENTORY_LEVELS_UPDATE = 'inventory_levels/update';

    public const LOCALES_CREATE = 'locales/create';

    public const LOCALES_UPDATE = 'locales/update';

    public const LOCATIONS_CREATE = 'locations/create';

    public const LOCATIONS_DELETE = 'locations/delete';

    public const LOCATIONS_UPDATE = 'locations/update';

    public const MARKETS_CREATE = 'markets/create';

    public const MARKETS_DELETE = 'markets/delete';

    public const MARKETS_UPDATE = 'markets/update';

    public const ORDER_TRANSACTIONS_CREATE = 'order_transactions/create';

    public const ORDERS_CANCELLED = 'orders/cancelled';

    public const ORDERS_CREATE = 'orders/create';

    public const ORDERS_DELETE = 'orders/delete';

    public const ORDERS_EDITED = 'orders/edited';

    public const ORDERS_FULFILLED = 'orders/fulfilled';

    public const ORDERS_PAID = 'orders/paid';

    public const ORDERS_PARTIALLY_FULFILLED = 'orders/partially_fulfilled';

    public const ORDERS_UPDATED = 'orders/updated';

    public const PRODUCT_LISTINGS_ADD = 'product_listings/add';

    public const PRODUCT_LISTINGS_REMOVE = 'product_listings/remove';

    public const PRODUCT_LISTINGS_UPDATE = 'product_listings/update';

    public const PRODUCTS_CREATE = 'products/create';

    public const PRODUCTS_DELETE = 'products/delete';

    public const PRODUCTS_UPDATE = 'products/update';

    public const PROFILES_CREATE = 'profiles/create';

    public const PROFILES_DELETE = 'profiles/delete';

    public const PROFILES_UPDATE = 'profiles/update';

    public const REFUNDS_CREATE = 'refunds/create';

    public const SCHEDULED_PRODUCT_LISTINGS_ADD = 'scheduled_product_listings/add';

    public const SCHEDULED_PRODUCT_LISTINGS_REMOVE = 'scheduled_product_listings/remove';

    public const SCHEDULED_PRODUCT_LISTINGS_UPDATE = 'scheduled_product_listings/update';

    public const SELLING_PLAN_GROUPS_CREATE = 'selling_plan_groups/create';

    public const SELLING_PLAN_GROUPS_DELETE = 'selling_plan_groups/delete';

    public const SELLING_PLAN_GROUPS_UPDATE = 'selling_plan_groups/update';

    public const SHOP_UPDATE = 'shop/update';

    public const SUBSCRIPTION_BILLING_ATTEMPTS_CHALLENGED = 'subscription_billing_attempts/challenged';

    public const SUBSCRIPTION_BILLING_ATTEMPTS_FAILURE = 'subscription_billing_attempts/failure';

    public const SUBSCRIPTION_BILLING_ATTEMPTS_SUCCESS = 'subscription_billing_attempts/success';

    public const SUBSCRIPTION_CONTRACTS_CREATE = 'subscription_contracts/create';

    public const SUBSCRIPTION_CONTRACTS_UPDATE = 'subscription_contracts/update';

    public const TENDER_TRANSACTIONS_CREATE = 'tender_transactions/create';

    public const THEMES_CREATE = 'themes/create';

    public const THEMES_DELETE = 'themes/delete';

    public const THEMES_PUBLISH = 'themes/publish';

    public const EVENT_TOPICS_THEMES_UPDATE = 'event-topics-themes-update';

    public const THEMES_UPDATE = 'themes/update';
}
