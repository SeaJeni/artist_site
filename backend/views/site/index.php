<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Zefi Studio';
?>

<?php if (Yii::$app->user->can('viewUser')): ?>
    <p><a class="btn btn-default" href="<?= Url::to(['user/index']); ?>">Работники &raquo;</a></p>
    <p><a class="btn btn-default" href="<?= Url::to(['type/index']); ?>">Виды работ &raquo;</a></p>
<?php endif; ?>

<?php if (Yii::$app->user->can('viewCustomer')): ?>
    <p><a class="btn btn-default" href="<?= Url::to(['customer/index']); ?>">Заказчики &raquo;</a></p>
<?php endif; ?>

<?php if (Yii::$app->user->can('viewStage')): ?>
    <p><a class="btn btn-default" href="<?= Url::to(['stage/index']); ?>">Стадии проекта &raquo;</a></p>
<?php endif; ?>

<p><a class="btn btn-default" href="<?= Url::to(['project/index']); ?>">Проекты &raquo;</a></p>

<p><a class="btn btn-default" href="<?= Url::to(['price-list/index']); ?>">Прайс лист &raquo;</a></p>

<p><a class="btn btn-default" href="<?= Url::to(['msg/index']); ?>">Рабочие чаты &raquo;</a></p>