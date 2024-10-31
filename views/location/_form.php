<?php

use app\models\Country;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\models\Location;

/**
 * @var View $this
 * @var Location $model
 * @var ActiveForm $form
 */

?>

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'country')->dropDownList(Country::list()); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>