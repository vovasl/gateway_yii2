<?php

namespace app\controllers;

use app\models\Country;
use app\models\Location;
use app\models\Logs;
use app\models\Order;
use app\models\PaymentType;
use app\modules\eghl\services\EghlService;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     * @return string
     */
    public function actionIndex(): string
    {
        $amount = Yii::$app->request->get('amount', '0.04');

        $payment = new EghlService();
        $paymentId = Order::setPaymentId();
        $locations = Location::find()->all();
        $paymentTypes = PaymentType::find()->all();

        $data = [
            'PaymentID' => $paymentId,
            'PaymentDesc' => 'Payment #' . $paymentId,
            'Amount' => $amount,
            'CurrencyCode' => Country::firstLocationCurrency($locations),
        ];

        return $this->render('index', [
            'payment' => $payment,
            'params' => $payment->getParams($data),
            'locations' => $locations,
            'payment_types' => $paymentTypes,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
