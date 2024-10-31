<?php

use yii\helpers\Html;
use yii\web\View;
use app\models\PaymentType;

/**
 * @var View $this
 * @var PaymentType $model
 */

$this->title = 'Create Payment Type';
$this->params['breadcrumbs'][] = ['label' => 'Payment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="payment-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
