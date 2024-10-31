<?php

namespace app\models;

use yii\base\Model;

class Environment extends Model
{

    CONST PRODUCTION = 1;
    CONST LIVE = 2;

    /**
     * @return string[]
     */
    public static function list(): array
    {
        return [
            self::PRODUCTION => 'Production',
            self::LIVE => 'Live'
        ];
    }

}