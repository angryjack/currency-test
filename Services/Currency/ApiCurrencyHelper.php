<?php

namespace App\Services\Currency;

use App\Models\ApiCurrency;
use App\Models\Currency;

/**
 * Работа с курсами валют через API.
 */
class ApiCurrencyHelper implements CurrencyReader
{
    public function get(string $code): Currency
    {
        //обращаемся к строннему api и получаем результат.
        //если произошла ошибка выбрасываем CurrencyApiException
        return new ApiCurrency();
    }
}
