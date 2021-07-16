<?php

use backend\models\Msg;
use floor12\files\components\FileListWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

//use dosamigos\tinymce\TinyMce;
//use mihaildev\elfinder\InputFile;
//use mihaildev\elfinder\ElFinder;
//use yii\web\JsExpression;
use floor12\files\components\FileInputWidget;

//use function floor12\files\components\FileListWidget;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\MsgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $projectDataProvider */
/* @var $model backend\models\Msg */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Msgs';
$this->params['breadcrumbs'][] = $this->title;
$timezone = Yii::$app->timezoneDetector->getClientTimezone();
?>

<style>
    .projectList{
        float: left; /* Обтекание по правому краю */
        border: 1px solid black; /* Параметры рамки */
        padding: 10px; /* Поля вокруг текста */
        margin-right: 20px; /* Отступ справа */
        width: 20%; /* Ширина блока */
    }

    .msgList {
        float: right;
        padding: 10px;
        margin-right: 20px;
        width: 70%;
    }

    .layerUser {
        width: 20%;
        font-weight: bold;
        padding: 10px;
    }

    .layerDate {
        width: 10%;
        font-size: 100%;
        color: grey;
    }

    .layerMsg {
        width: 70%;
        word-break: break-all;
    }

    .sendMsg {
        float: right;
        border: 1px solid black;
        padding: 10px;
        margin-right: 20px;
        width: 70%;
    }

    .fileMsg {
        float: right;
        padding: 10px;
        margin-right: 20px;
        width: 35%;
    }

    .textMsg  {
        float: left;
        padding: 10px;
        margin-right: 10px;
        width: 60%;
    }
</style>
<div class="msg-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <? $request = Yii::$app->request;

    $get = $request->get();
    // эквивалентно: $get = $_GET;

    $id = $request->get('id');
    ?>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
    <div class="sendMsg">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


        <div class="textMsg ">
            <?= $form->field($model, 'msg')->textInput(['maxlength' => true])->label(false) ?>
        </div>
        <div class="fileMsg">
            <?= $form->field($model, 'documents')->widget(FileInputWidget::class)->label(false) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>

        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="msgList ">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'showHeader' => false,
            'tableOptions' => [
                'class' => 'table' // можно задать свой, тут 100% ширина блока
            ],
            'layout' => '{items}{pager}',
            'columns' => [

                ['attribute' => 'user_id',
                    'value' => function ($data) {
                        return $data->user->username;
                    },
                    'format' => 'html',
                    'contentOptions' => ['class' => 'layerUser'],
                ],

                ['attribute' => 'msg',
                    'contentOptions' => ['class' => 'layerMsg']
                ],

                [
                    'attribute' => 'document',
                    'value' => function (Msg $data) {
                        return FileListWidget::widget([
                            'files' => $data->documents,
                            'downloadAll' => true,
                            // 'allowImageSrcDownload' => true,
                        ]);
                    },
                    'format' => 'raw',
                ],

                [
                    'attribute' => 'date',
                    'value' => function (Msg $data) use ($timezone): string {
                        return (new DateTime($data->date))->setTimezone(new DateTimeZone($timezone))->format('Y-m-d H:i:s');
                    },

                ],


            ],
        ]);

        ?>

    </div>

</div>
