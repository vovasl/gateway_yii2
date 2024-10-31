<?php

use app\models\Environment;
use app\models\Type;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\models\PaymentType;

/**
 * @var View $this
 * @var PaymentType $model
 * @var ActiveForm $form
 */

?>

<div class="payment-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'type')->dropDownList(Type::list()); ?>

    <?= $form->field($model, 'environment')->dropDownList(Environment::list()); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
