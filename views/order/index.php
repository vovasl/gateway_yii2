<?php

use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\View;
use app\models\search\OrderSearch;
use yii\data\ActiveDataProvider;

/**
 * @var View $this
 * @var OrderSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

<!--    <p>
        <?/*= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'amount',
            'payment_id',
            [
                'attribute' => 'status',
                'value' => function (Order $model) {
                    return $model->getStatus();
                },
                'filter' => Order::statuses()
            ],
            'created_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
