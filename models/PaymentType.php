<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "payment_type".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $type
 * @property int $environment
 * @property string|null $created_at
 */
class PaymentType extends ActiveRecord
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
        return 'payment_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['code', 'name', 'type', 'environment'], 'required'],
            [['type', 'environment'], 'integer'],
            [['created_at'], 'safe'],
            [['code', 'name'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'environment' => 'Environment',
            'created_at' => 'Created',
        ];
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return Type::list()[$this->type] ?? null;
    }

    /**
     * @return string|null
     */
    public function getEnvironment(): ?string
    {
        return Environment::list()[$this->environment] ?? null;
    }
}
