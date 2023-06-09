<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ShopifyCustomerState extends Enum
{
    public const DECLINED = 'declined';

    public const DISABLED = 'disabled';

    public const ENABLED = 'enabled';

    public const INVITED = 'invited';
}
