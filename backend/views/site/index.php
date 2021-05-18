<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Adminka';
?>


                <p><a class="btn btn-default" href="<?=Url::to(['user/index']);?>">Работники &raquo;</a></p>
                <p><a class="btn btn-default" href="<?=Url::to(['customer/index']);?>">Заказчики &raquo;</a></p>
                <p><a class="btn btn-default" href="<?=Url::to(['stage/index']);?>">Стадии проекта &raquo;</a></p>
                <p><a class="btn btn-default" href="<?=Url::to(['project/index']);?>">Проекты &raquo;</a></p>
                <p><a class="btn btn-default" href="<?=Url::to(['price-list/index']);?>">Прайс работников &raquo;</a></p>