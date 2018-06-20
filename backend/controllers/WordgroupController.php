<?php
namespace backend\controllers;

use Yii;
use backend\models\Wordgroup;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;

class WordgroupController extends CommonController{
	public $enableCsrfValidation = false;
	//词组列表
	public function actionWordList(){
		$query=Wordgroup::find();
		$count=$query->count();
		$pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 1]);
		$data['word'] = $query->offset($pagination->offset)
		->limit($pagination->limit)
		->asArray()
		->all();
		$data['page']=LinkPager::widget([
			'pagination' => $pagination,
		]);
		if(Yii::$app->request->isAjax){
			return json_encode($data);
		}

		return $this->render('wordlist',['data'=>$data]);
	}
	//添加词组
	public function actionWordAdd(){
		//假设这个方法对应的权限是updateGoods
		if (!Yii::$app->user->can('updateGoods')){
			throw new ForbiddenHttpException('您没有权限操作');
		}

		$request=Yii::$app->request;
		if($request->isPost){
			$model=new Wordgroup();
			$model->civilian=$request->post('civilian');
			$model->dinting=$request->post('dinting');
			if($model->save()){
				return $this->redirect(['wordgroup/word-list']);
			}else{
				echo "<script>alert('添加失败')</script>";
				return $this->goBack();
			}
		}
		return $this->render('wordadd');
	
	}

	//学习yii框架图片上传
	public function actionUpload()
	{
		$model = new \backend\models\Image();
		$request=Yii::$app->request;//调用请求组件

		if ($model->load($request->post())) {
				$upload=UploadedFile::getInstance($model, 'image_url');
				$imageName= md5($upload->baseName) . '.' . $upload->extension;
				$imageUrl='uploads/' .$imageName;
				$upload->saveAs($imageUrl);
				$model->image_url='./'.$imageUrl;
				$model->addtime=time();
				if($model->save()){

					return $this->redirect(['wordgroup/upload']);
				}else{
					var_dump($model->getErrors());die;
					//throw new ForbiddenHttpException('添加失败');
				}
				

		}

		return $this->render('upload', [
			'model' => $model,
		]);
	}






}