<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PunishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '惩罚内容管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="punish-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加惩罚', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'punish_id',
            'content',
            //'is_use',
			[
				'attribute'=>'is_use',
				'value'=>function($model){
					return $model->is_use?'启用':'未启用';
				}
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
