<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Punish */

$this->title = 'Update Punish: ' . $model->punish_id;
$this->params['breadcrumbs'][] = ['label' => 'Punishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->punish_id, 'url' => ['view', 'id' => $model->punish_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="punish-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
