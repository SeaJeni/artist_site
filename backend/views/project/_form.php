<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList(['0'=> 'Закрыт',
    '1' => 'Открыт']) ?>

    <?= $form->field($model, 'stage_id')->dropDownList(\yii\helpers\ArrayHelper::map(backend\models\Stage::find()->all(),'id', 'name')) ?>

    <?= $form->field($model, 'type_id')->dropDownList(\yii\helpers\ArrayHelper::map(backend\models\Type::find()->all(),'id', 'name')) ?>

    <?= $form->field($model, 'manager_id')->dropDownList(\yii\helpers\ArrayHelper::map(backend\models\User::find()->where(['role_id'=> 2])->all(),'id', 'username')) ?>

    <?= $form->field($model, 'main_artist_id')->dropDownList(\yii\helpers\ArrayHelper::map(backend\models\User::find()->where(['role_id'=> 3])->all(),'id', 'username')) ?>

    <?= $form->field($model, 'artist_id')->dropDownList(\yii\helpers\ArrayHelper::map(backend\models\User::find()->where(['role_id'=> 4])->all(),'id', 'username')) ?>

<!--    <? $form->field($model, 'start_time')->textInput() ?>-->

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?= $form->field($model, 'deadline')->textInput() ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <?= $form->field($model, 'customer_id')->dropDownList(\yii\helpers\ArrayHelper::map(backend\models\Customer::find()->all(),'id', 'last_name')) ?>

    <?= $form->field($model, 'payment_status')->dropDownList(['0'=> 'Не оплачен', '1' => 'Оплачен']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
