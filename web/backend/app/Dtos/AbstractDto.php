<?php

namespace App\Dtos;

use Illuminate\Support\Collection;

abstract class AbstractDto
{
    public static function collections(array $items): Collection
    {
        $result = new Collection();
        foreach ($items as $item) {
            $itemDto = new static($item);
            $result->push($itemDto);
        }

        return $result;
    }
}
