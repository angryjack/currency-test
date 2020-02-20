<?php

$code = 'EUR';

$currencyService = new \App\Services\CurrencyService();
$currency = $currencyService->getByCode($code);
