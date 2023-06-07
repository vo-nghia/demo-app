<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ShopifyResponseDataType extends Enum
{
    public const DATA_TYPE_JSON = 'application/json';

    public const DATA_TYPE_GRAPHQL = 'application/graphql';
}
