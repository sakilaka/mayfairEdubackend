<?php

use App\Models\Currency;

use function Webmozart\Assert\Tests\StaticAnalysis\float;

function setApplicationCurrency(Currency $currency)
{

    if (session('currency') == $currency->currency_name) {
        return;
    }

    session(['currency' => $currency->currency_name]);
}

function getApplicationCurrency()
{
    if (session('currency')) {
        $currency = Currency::where('currency_name', session('currency'))->first();
    } else {
        $currency = Currency::where('is_default', 1)->first();
    }
    return $currency;
}

function format_price($price)
{
    if (!is_numeric($price)) {
        return  $price;
    }
    $currency = getApplicationCurrency();
    if ($currency) {
        $price = (float)$currency->exchange_rate ? ((float)$currency->exchange_rate * $price) : $price;
        $numberAfterDot = $currency ? $currency->decimal_digit : 0;
        if ($currency->thousands_separator == "point") {
            $t_s = '.';
        } else if ($currency->thousands_separator == "comma") {
            $t_s = ',';
        } else {
            $t_s = ' ';
        }
        if ($currency->decimal_separator == "point") {
            $d_s = '.';
        } else if ($currency->decimal_separator == "comma") {
            $d_s = ',';
        } else {
            $d_s = ' ';
        }
        $price = number_format(
            (float)$price,
            (int)$numberAfterDot,
            $d_s,
            $t_s
        );
        if ($currency->currency_position == "left") {
            return $currency->currency_icon . $price;
        } else {
            return $price . $currency->currency_icon;
        }
    }
    return $price;
}

if (!function_exists('convertCurrency')) {
    function convertCurrency($value)
    {
        $current_currency = getApplicationCurrency();
        $exchange_rate = (float) $current_currency->exchange_rate;
        $converted_fee = (float) $value * $exchange_rate;

        // Apply different number formatting based on the currency
        if ($current_currency->currency_name == 'USD') {
            return $current_currency->currency_icon . number_format($converted_fee, 0);
        } else {
            return $current_currency->currency_icon . number_format($converted_fee, 0, '.', ',');
        }
    }
}

if (!function_exists('convertToDefaultCurrency')) {
    function convertToDefaultCurrency($value)
    {
        $default_currency = Currency::where('is_default', 1)->first();
        $current_currency = getApplicationCurrency();

        if ($current_currency->currency_name != $default_currency->currency_name) {
            $exchange_rate = (float) $current_currency->exchange_rate;
            $default_exchange_rate = (float) $default_currency->exchange_rate;

            // Convert to base value (USD or any base currency) and then to default currency
            $value_in_base_currency = (float) $value / $exchange_rate;
            $converted_value = $value_in_base_currency * $default_exchange_rate;

            return $converted_value;
        }

        return (float) $value;
    }
}

if (!function_exists('convertRawCurrency')) {
    function convertRawCurrency($value)
    {
        $current_currency = getApplicationCurrency();
        $exchange_rate = (float) $current_currency->exchange_rate;
        $converted_fee = (float) $value * $exchange_rate;

        return $converted_fee;
    }
}
