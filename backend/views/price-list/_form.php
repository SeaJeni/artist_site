<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PriceList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="price-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput()->dropDownList(\yii\helpers\ArrayHelper::map(backend\models\User::find()->all(),'id', 'username')) ?>

    <?= $form->field($model, 'stage_id')->textInput()->dropDownList(\yii\helpers\ArrayHelper::map(backend\models\Stage::find()->all(),'id', 'name')) ?>

    <?= $form->field($model, 'type_id')->textInput()->dropDownList(\yii\helpers\ArrayHelper::map(backend\models\Type::find()->all(),'id', 'name')) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
