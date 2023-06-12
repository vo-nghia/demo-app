<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class WebhookFormatType extends Enum
{
    public const JSON = 'json';

    public const XML = 'xml';
}
