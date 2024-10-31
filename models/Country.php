<?php

namespace app\models;

use yii\base\Model;

class Country extends Model
{

    CONST MALAYSIA = 1;
    CONST SINGAPORE = 2;
    CONST THAILAND = 3;
    CONST CHINA = 4;
    CONST PHILIPPINE = 5;

    CONST DEFAULT_CURRENCY = 'MYR';

    public static function list(): array
    {
        return [
            self::MALAYSIA => 'Malaysia',
            self::SINGAPORE => 'Singapore',
            self::THAILAND => 'Thailand',
            self::CHINA => 'China',
            self::PHILIPPINE => 'Philippine',
        ];
    }

    /**
     * @return string[]
     */
    public static function currencyList(): array
    {
        return [
            self::MALAYSIA => 'MYR',
            self::SINGAPORE => 'SGD',
            self::THAILAND => 'THB',
            self::CHINA => 'CNY',
            self::PHILIPPINE => 'PHP',
        ];
    }

    /**
     * @param int $id
     * @return string
     */
    public static function getCurrency(int $id): string
    {
        return self::currencyList()[$id] ?? self::DEFAULT_CURRENCY;
    }

    /**
     * @param array $models
     * @return string
     */
    public static function firstLocationCurrency(array $models): string
    {
        if (!isset($models[0])) {
            return self::DEFAULT_CURRENCY;
        }

        return self::getCurrency($models[0]->country);
    }

}