<?php

namespace App\Services\Currency;

use App\Models\CacheCurrency;
use App\Models\Currency;

/**
 * Работа с курсами валют из кеша.
 */
class CacheCurrencyHelper implements CurrencyReader, CurrencyWriter
{
    public function get(string $code): ?Currency
    {
        //todo получаем их кеша
        return new CacheCurrency();
    }

    public function put(Currency $currency): bool
    {
        //todo сохраняем в кеш
        return true;
    }
}
