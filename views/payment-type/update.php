<?php

use yii\helpers\Html;
use yii\web\View;
use app\models\PaymentType;

/**
 * @var View $this
 * @var PaymentType $model
 */

$this->title = 'Update Payment Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Payment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

?>

<div class="payment-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
