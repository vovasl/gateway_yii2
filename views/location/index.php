<?php

use app\models\Country;
use app\models\Location;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\View;
use app\models\search\LocationSearch;
use yii\data\ActiveDataProvider;

/**
 * @var View $this
 * @var LocationSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Locations';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="location-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Location', ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute' => 'country',
                'value' => function (Location $model) {
                    return $model->getCountry();
                },
                'filter' => Country::list()
            ],
            'created_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Location $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
