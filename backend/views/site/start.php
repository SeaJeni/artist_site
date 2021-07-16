<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Zefi Studio';
?>
<h3>Пожалуйста зарегистрируйтесь</h3>
<p><a class="btn btn-default" href="<?= Url::to(\Yii::$app->urlManagerFrontEnd->baseUrl); ?>">Регистрация &raquo;</a>
</p>
<h3>Или авторизируйтесь</h3>
<p><a class="btn btn-default" href="<?= Url::to(['/site/login']); ?>">Авторизация &raquo;</a></p>