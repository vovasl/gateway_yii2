<?php

namespace app\controllers;

use app\models\Logs;
use app\models\Order;
use app\modules\eghl\services\EghlService;
use Yii;
use yii\base\Action;
use yii\db\Exception;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class EghlController extends Controller
{

    /**
     * @param Action $action
     * @return bool
     * @throws BadRequestHttpException
     */
    public function beforeAction($action): bool
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * @return string
     * @throws Exception|NotFoundHttpException
     */
    public function actionIndex(): string
    {
        $post = Yii::$app->request->post();
        Logs::add(Logs::INFO, $post, 'Eghl - Post');

        $payment = new EghlService();
        if (!$payment->validatePaymentResponse($post)) {
            throw new NotFoundHttpException('The requested page does not exist');
        }

        if (!$order = Order::find()->where(['payment_id' => $post['PaymentID']])->one()) {
            throw new NotFoundHttpException('The requested Payment ID does not exist');
        }

        $order->status = $post['TxnStatus'];
        $order->save();

        return $this->render('index', [
            'order' => $order,
            'post' => $post
        ]);
    }

}