<?php

namespace App\Services\Currency;

use App\Models\Currency;

/**
 * Интерфейс для записи курсов валют.
 */
interface CurrencyWriter
{
    public function put(Currency $currency): bool;
}