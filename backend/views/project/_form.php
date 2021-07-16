<?php

use backend\models\Customer;
use backend\models\Stage;
use backend\models\Type;
use backend\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
/* @var $artist User[] */
/* @var $mainArtists User[] */
/* @var $manager User[] */
?>

<div class="project-form">
    <?php if (Yii::$app->user->can('manager')): ?>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList(['0' => 'Закрыт',
            '1' => 'Открыт']) ?>

        <?= $form->field($model, 'stage_id')->dropDownList(ArrayHelper::map(Stage::find()->all(), 'id', 'name')) ?>

        <?= $form->field($model, 'type_id')->dropDownList(ArrayHelper::map(Type::find()->all(), 'id', 'name')) ?>

        <?= $form->field($model, 'manager_id')->dropDownList(ArrayHelper::map($manager, 'id', 'username')) ?>

        <?= $form->field($model, 'main_artist_id')->dropDownList(ArrayHelper::map($mainArtists ?? [], 'id', 'username')) ?>

        <? $artistAll = [
            'Главные художники' => ArrayHelper::map($mainArtists, 'id', 'username'),

            'Художники' => ArrayHelper::map($artist, 'id', 'username'),

        ]; ?>

        <?= $form->field($model, 'artist_id')->dropDownList($artistAll) ?>
        <?// $form->field($model, 'artist_id')->dropDownList(ArrayHelper::map($artist, 'id', 'username')) ?>

        <!--    <? $form->field($model, 'start_time')->textInput() ?>-->

        <?= $form->field($model, 'end_time')->widget(DatePicker::class, [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
        ]);
        ?>

        <?= $form->field($model, 'deadline')->textInput()->widget(DatePicker::classname(), [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
        ]);
        ?>

        <?= $form->field($model, 'cost')->textInput() ?>

        <?= $form->field($model, 'customer_id')
            ->dropDownList(ArrayHelper::map(Customer::find()->all(), 'id', 'last_name')) ?>

        <?= $form->field($model, 'payment_status')->dropDownList(['0' => 'Не оплачен', '1' => 'Оплачен']) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php endif; ?>
    <?php if (Yii::$app->user->can('main_artist')): ?>
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'stage_id')->dropDownList(ArrayHelper::map(backend\models\Stage::find()->all(), 'id', 'name')) ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php endif; ?>
</div>
