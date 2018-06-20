<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Punish */

$this->title = 'Create Punish';
$this->params['breadcrumbs'][] = ['label' => 'Punishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="punish-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
