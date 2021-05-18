<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
                       // 'id',
            'name',
            //'status',
             [ 'attribute'=> 'status',
               'value' => $model->status=='0'?'Закрыт':'Открыт',

               
            ],
            //'stage_id',
            [ 'attribute'=>'stage_id',
                'value'=>$model->stage->name,
            ], 
            //'type_id',
            [ 'attribute'=>'type_id',
                'value'=>$model->type->name,
            ], 
            //'manager_id',
            [ 'attribute'=>'manager_id',
                'value'=>$model->manager->username,
            ], 
           // 'main_artist_id',
            [ 'attribute'=>'main_artist_id',
                'value'=>$model->mainArtist->username,
            ], 
           // 'artist_id',
             [ 'attribute'=>'artist_id',
                'value'=>$model->artist->username,
            ], 
            'start_time',
            'end_time',
            'deadline',
            'cost',
            //'customer_id',
             [ 'attribute'=>'customer_id',
                'value'=>$model->customer->last_name,
            ], 

            //'payment_status',
             [ 'attribute'=> 'payment_status',
               'value' => $model->payment_status=='0'?'Не оплачен':'Оплачен',

               
            ],
        ],
    ]) ?>

</div>
