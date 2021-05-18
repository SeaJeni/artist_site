<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PriceListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Price Lists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="price-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Price List', ['create'], ['class' => 'btn btn-success']) ?>
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
            //'stage_id',
            [ 'attribute'=>'stage_id',
                'value' => function($data){
                    return $data->stage->name;

                },
                'format' => 'html',
            ],
            //'type_id',
                  [ 'attribute'=>'type_id',
                'value' => function($data){
                    return $data->type->name;

                },
                'format' => 'html',
            ],      
            'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
