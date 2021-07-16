<?php

use backend\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $artist User[] */
/* @var $mainArtists User[] */
/* @var $manager User[] */

$this->title = 'Create Project';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'artist' => $artist,
        'mainArtists' => $mainArtists,
        'manager' => $manager,
    ]) ?>

</div>
