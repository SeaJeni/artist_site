<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PriceList */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Price Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="price-list-view">

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
            //'id',
            //'user_id',
            [ 'attribute'=>'user_id',
                'value'=>$model->user->username,
            ], 
            //'stage_id',
             [ 'attribute'=>'stage_id',
                'value'=>$model->stage->name,
            ], 
            //'type_id',
             [ 'attribute'=>'type_id',
                'value'=>$model->type->name,
            ], 
            'price',
        ],
    ]) ?>

</div>
