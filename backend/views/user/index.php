<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Работники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <? //Html::a('Создать работника', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',

            'email:email',

            ['attribute' => 'status',
                'value' => function ($data) {
                    return $data->status == '9' ? 'Неподтвержденный' : 'Подтвержденный';

                },
                'format' => 'html',
            ],

            'telegram',
            'avatar',

            ['attribute' => 'roles',
                'value' => function ($data) {
                    return implode(',', $data->getRoles());
                },
                'format' => 'html',
                'label' => 'Роль',
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
