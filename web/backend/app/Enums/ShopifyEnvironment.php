<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ShopifyEnvironment extends Enum
{
    public const LOCAL = 'local';

    public const STAGING = 'stg';

    public const PRODUCTION = 'prd';
}
