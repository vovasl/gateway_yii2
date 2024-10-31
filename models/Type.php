<?php

namespace app\models;

use yii\base\Model;

class Type extends Model
{

    CONST IPAY88 = 1;
    CONST QNB = 2;
    CONST OTTU = 3;

    /**
     * @return string[]
     */
    public static function list(): array
    {
        return [
            self::IPAY88 => 'iPay88',
            self::QNB => 'QNB',
            self::OTTU => 'Ottu'
        ];
    }

}