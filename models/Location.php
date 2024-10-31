<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $country
 * @property string|null $created_at
 */
class Location extends ActiveRecord
{

    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => function () {
                    return new  Expression('NOW()');
                },
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['code', 'name', 'country'], 'required'],
            [['created_at'], 'safe'],
            [['code', 'name'], 'string', 'max' => 255],
            [['country'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'country' => 'Country',
            'created_at' => 'Created',
        ];
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return Country::list()[$this->country] ?? null;
    }
}
