<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MsgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $projectDataProvider */
/* @var $model backend\models\Msg */
$this->title = 'Msgs';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .projectList {
        float: left; /* Обтекание по правому краю */
        border: 1px solid black; /* Параметры рамки */
        padding: 10px; /* Поля вокруг текста */
        margin-right: 20px; /* Отступ справа */
        width: 20%; /* Ширина блока */
    }

</style>

<div class="msg-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="projectList">
        <?=
        GridView::widget([
            'dataProvider' => $projectDataProvider,


            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['attribute' => 'name',
                    'format' => 'raw',

                    'value' => function ($data) {
                        return Html::a((string)($data->name), ['msg/view', 'id' => $data->id]);
                    },
                ]
            ],
        ]);
        ?>
    </div>
    <h2>Выберите проект</h2>

</div>
