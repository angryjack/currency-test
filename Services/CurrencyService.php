<?php

namespace App\Services;

use App\Exceptions\CurrencyApiException;
use App\Models\Currency;
use App\Services\Currency\ApiCurrencyHelper;
use App\Services\Currency\CacheCurrencyHelper;
use App\Services\Currency\DbCurrencyHelper;

/**
 * Класс для получения курсов валют.
 */
class CurrencyService
{
    /**
     * @var CacheCurrencyHelper
     */
    private $cacheCurrencyHelper;
    /**
     * @var DbCurrencyHelper
     */
    private $dbCurrencyHelper;
    /**
     * @var ApiCurrencyHelper
     */
    private $apiCurrencyHelper;

    public function __construct(
        ApiCurrencyHelper $apiCurrencyHelper,
        CacheCurrencyHelper $cacheCurrencyHelper,
        DbCurrencyHelper $dbCurrencyHelper

    ) {
        $this->cacheCurrencyHelper = $cacheCurrencyHelper;
        $this->dbCurrencyHelper = $dbCurrencyHelper;
        $this->apiCurrencyHelper = $apiCurrencyHelper;
    }

    public function getByCode(string $code): Currency
    {
        return $this->getFromCache($code);
    }

    private function getFromCache(string $code): ?Currency
    {
        // получаем из кеша
        $model = $this->cacheCurrencyHelper->get($code);

        // если в кеше нет данных, то пытаемся получить их БД.
        if (!$model) {
            $model = $this->getFromDb($code);
            // записываем в кеш.
            $this->cacheCurrencyHelper->put($model);
        }

        return $model;
    }

    private function getFromDb(string $code): ?Currency
    {
        //получаем модель курса валюты из бд.
        $model = $this->dbCurrencyHelper->get($code);

        // если в БД нет данных, дергаем api
        if (!$model) {
            $model = $this->getFromApi($code);
            // записываем данные в БД.
            $this->dbCurrencyHelper->put($model);
        }

        return $model;
    }

    /**
     * @param string $code
     * @throws CurrencyApiException
     * @return Currency
     */
    private function getFromApi(string $code): Currency
    {
        //fixme тут должна быть обработка исключения, но мы ее опустим, чтобы не тратить время.
        return $this->apiCurrencyHelper->get($code);
    }
}
