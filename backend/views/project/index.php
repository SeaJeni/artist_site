<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->can('manager')): ?>
        <p>
            <?= Html::a('Создать проект', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'name',

            ['attribute' => 'status',
                'value' => function ($data) {
                    return $data->status == '0' ? 'Закрыт' : 'Открыт';
                },
                'format' => 'html',
            ],

            ['attribute' => 'stage_id',
                'value' => function ($data) {
                    return $data->stage->name;
                },
            ],


            ['attribute' => 'type',
                'value' => function ($data) {
                    return $data->type->name;
                },
                'label' => 'Тип',

            ],
//

            ['attribute' => 'manager_id',
                'value' => function ($data) {
                    return $data->manager->username;
                },
            ],

            ['attribute' => 'main_artist_id',
                'value' => function ($data) {
                    return $data->mainArtist->username;
                },
            ],

            ['attribute' => 'artist_id',
                'value' => function ($data) {
                    return $data->artist->username;
                },
            ],

            ['attribute' => 'start_time',
                'format' => ['DateTime', 'php:d-m-Y']
            ],

            ['attribute' => 'end_time',
                'format' => ['DateTime', 'php:d-m-Y']
            ],

            ['attribute' => 'deadline',
                'format' => ['DateTime', 'php:d-m-Y']
            ],

            'cost',

            ['attribute' => 'customer',
                'value' => function ($data) {
                    return $data->customer->last_name;
                },
                'label' => 'Заказчик',
            ],


            ['attribute' => 'payment_status',
                'value' => function ($data) {
                    return $data->payment_status == '0' ? 'Не оплачен' : 'Оплачен';
                },
                'format' => 'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
