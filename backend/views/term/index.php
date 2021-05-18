<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TermSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Terms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="term-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Term', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'stage_id',
            'project_id',
            'start_time',
            'end_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
