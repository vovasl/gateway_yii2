<?php

namespace app\controllers;

use app\models\Country;
use app\models\Location;
use app\models\Order;
use app\modules\eghl\services\EghlService;
use Yii;
use yii\db\Exception;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\Response;

class RestController extends Controller
{

    /**
     * @inheritDoc
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ]);
    }

    /**
     * @return array|false
     */
    public function actionLocation()
    {

        if (!Yii::$app->request->isAjax) {
            Yii::$app->response->statusCode = 422;
            return false;
        }

        $post = Yii::$app->request->post();
        $model = Location::find()->where(['id' => $post['location']])->one();

        $data = [
            'PaymentID' => $post['PaymentID'],
            'OrderNumber' => $post['OrderNumber'],
            'PaymentDesc' => 'Order #' . $post['OrderNumber'],
            'Amount' => $post['Amount'],
            'CurrencyCode' => Country::getCurrency($model->country),
        ];
        $payment = new EghlService();

        return $payment->getParams($data);
    }

    /**
     * @return array|false
     * @throws Exception
     */
    public function actionOrderCreate()
    {
        if (!Yii::$app->request->isAjax) {
            Yii::$app->response->statusCode = 422;
            return false;
        }

        $post = Yii::$app->request->post();
        $data = [
            'amount' => $post['Amount'],
            'payment_id' => $post['PaymentID'],
            'location_id' => $post['location'] ?? null,
            'payment_type_id' => $post['payment-type'] ?? null,
            'name' => $post['CustName'],
            'email' => $post['CustEmail'],
            'phone' => $post['CustPhone'],
        ];
        Order::create($data);

        return [];
    }

}