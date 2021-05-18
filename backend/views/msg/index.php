<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MsgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Msgs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="msg-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Msg', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            [ 'attribute'=>'user_id',
                'value' => function($data){
                    return $data->user->username;

                },
                'format' => 'html',
            ],
            //'project_id',
              [ 'attribute'=>'project_id',
                'value' => function($data){
                    return $data->project->name;

                },
                'format' => 'html',
            ],
            'msg',
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
