<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\db\Expression;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $amount
 * @property int $payment_id
 * @property int $status
 * @property string|null $created_at
 */
class Order extends ActiveRecord
{

    CONST STATUS_SUCCESSFUL = 0;
    CONST STATUS_FAIL = 1;
    CONST STATUS_PENDING = 2;

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
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['amount', 'payment_id', 'status'], 'required'],
            [['amount'], 'string'],
            [['payment_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'payment_id' => 'Payment ID',
            'status' => 'Status',
            'created_at' => 'Created',
        ];
    }

    /**
     * @return string[]
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_SUCCESSFUL => 'Successful',
            self::STATUS_FAIL => 'Failed',
            self::STATUS_PENDING => 'Pending',
        ];
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return self::statuses()[$this->status] ?? null;
    }

    /**
     * @return int
     */
    public static function setPaymentId(): int
    {
        return rand(10000, 999999999999999999);
    }

    /**
     * @param array $params
     * @return Order
     * @throws Exception
     */
    public static function create(array $params): Order
    {
        $order = new Order();
        $order->amount = $params['amount'];
        $order->payment_id = $params['payment_id'];
        $order->status = self::STATUS_PENDING;
        //$order->location_id = $params['location_id'];
        //$order->payment_type_id = $params['payment_type_id'];
        //$order->name = $params['name'];
        //$order->email = $params['email'];
        //$order->phone = $params['phone'];
        $order->save();

        return $order;
    }
}
