<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //'id',
            'name',
            //'status',
             [ 'attribute'=> 'status',
                'value' => function($data){
                    return $data->status=='0'?'Закрыт':'Открыт';

                },
                'format' => 'html',
            ],
            //'stage_id',
             [ 'attribute'=>'stage_id',
                'value' => function($data){
                    return $data->stage->name;

                },
              
            ],
            //'type_id',
                         [ 'attribute'=>'type_id',
                'value' => function($data){
                    return $data->type->name;

                },
              
            ],
            //'manager_id',
                         [ 'attribute'=>'manager_id',
                'value' => function($data){
                    return $data->manager->username;

                },
            
            ],
            //'main_artist_id',
                         [ 'attribute'=>'main_artist_id',
                'value' => function($data){
                    return $data->mainArtist->username;

                },
             
            ],
           // 'artist_id',
                         [ 'attribute'=>'artist_id',
                'value' => function($data){
                    return $data->artist->username;

                },
             
            ],
           'start_time',
           'end_time',
            'deadline',
            'cost',
          //  'customer_id',
            [ 'attribute'=>'customer_id',
                'value' => function($data){
                    return $data->customer->last_name;

                },
               
            ],

            //'payment_status',
           [ 'attribute'=> 'payment_status',
                'value' => function($data){
                    return $data->payment_status=='0'?'Не оплачен':'Оплачен';

                },
               'format' => 'html',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
