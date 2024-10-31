<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\Expression;
use yii\helpers\Json;

/**
 * This is the model class for table "logs".
 *
 * @property int $id
 * @property int $level
 * @property string $category
 * @property string $message
 * @property string $created_at
 */

class Logs extends ActiveRecord
{

    const ERROR = 1;
    const WARNING = 2;
    const INFO = 4;

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
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['level'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'level' => 'Level',
            'category' => 'Category',
            'message' => 'Message',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @param int $level
     * @param $message
     * @param string|null $category
     * @throws Exception
     */
    public static function add(int $level, $message, string $category = null)
    {
        $model = new self();
        $model->level = $level;
        $model->message = (is_string($message)) ? $message : Json::encode($message);
        $model->category = $category;

        $model->save(0);
    }
}
