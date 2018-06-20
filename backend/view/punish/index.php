<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PunishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Punishes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="punish-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Punish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'punish_id',
            'content',
            'is_use',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
