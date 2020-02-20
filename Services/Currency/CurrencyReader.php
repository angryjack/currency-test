<?php

namespace App\Services\Currency;

use App\Models\Currency;

/**
 * Интерфейс для получения курсов валют.
 */
interface CurrencyReader
{
    public function get(string $code): ?Currency;
}