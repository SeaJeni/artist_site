<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Msg */

$this->title = 'Create Msg';
$this->params['breadcrumbs'][] = ['label' => 'Msgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="msg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
