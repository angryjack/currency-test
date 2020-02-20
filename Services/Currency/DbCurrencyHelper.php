<?php

namespace App\Services\Currency;

use App\Models\Currency;
use App\Models\DbCurrency;

/**
 * Работа с курсами валют из базы данных.
 */
class DbCurrencyHelper implements CurrencyReader, CurrencyWriter
{
    public function get(string $code): ?Currency
    {
        //todo получаем из бд
        return new DbCurrency();
    }

    public function put(Currency $currency): bool
    {
        //todo сохраняем в бд
        return true;
    }
}
