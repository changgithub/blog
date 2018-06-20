<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Punish */

$this->title = '添加惩罚';
$this->params['breadcrumbs'][] = ['label' => '惩罚管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="punish-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
