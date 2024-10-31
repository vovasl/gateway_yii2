<?php

use app\models\PaymentType;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\View;
use app\models\search\PaymentTypeSearch;
use yii\data\ActiveDataProvider;
use app\models\Environment;
use app\models\Type;

/**
 * @var View $this
 * @var PaymentTypeSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Payment Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Payment Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'code',
            'name',
            [
                'attribute' => 'type',
                'value' => function (PaymentType $model) {
                    return $model->getType();
                },
                'filter' => Type::list()
            ],
            [
                'attribute' => 'environment',
                'value' => function (PaymentType $model) {
                    return $model->getEnvironment();
                },
                'filter' => Environment::list()
            ],
            //'created_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, PaymentType $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
