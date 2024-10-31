<?php

use app\models\Environment;
use app\models\Type;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use yii\web\View;
use app\models\PaymentType;

/**
 * @var View $this
 * @var PaymentType $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Payment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);

?>

<div class="payment-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'created_at',
        ],
    ]) ?>

</div>
