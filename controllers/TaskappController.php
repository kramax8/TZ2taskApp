<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\DateToTimeBehavior;
use app\models\Taskapp;
use yii\db\ActiveRecord;

class TaskappController extends Controller
{

	public function behaviors()
{
    return [
       [
           'class' => DateToTimeBehavior::className(),
           'attributes' => [
                ActiveRecord::EVENT_BEFORE_VALIDATE => 'created_at_formatted',
                ActiveRecord::EVENT_AFTER_FIND => 'created_at_formatted',
            ],
            'timeAttribute' => 'deadline'
        ],
    ];
}

	public $layout = 'taskmain';

	public function actionIndex() {

        $tCountAll = Taskapp::find()->orderBy('id')->count();
        $tCountNew = Taskapp::find()
            ->where(['status' => '0'])->count();
        $tCountProg = Taskapp::find()
            ->where(['status' => '1'])->count();
        $tCountFin = Taskapp::find()
            ->where(['status' => '2'])->count();

		$pri = ['0'=>'Низкий','1'=>'Средний','2'=>'Высокий'];
		$sta = ['0'=>'Новый','1'=>'В работе','2'=>'Завершено'];

        $model = new Taskapp();

        $searchDesc = Yii::$app->request->get();

        $tasks = null;

        if(isset($searchDesc['Taskapp']['desc']) && $searchDesc['Taskapp']['desc'] != null){
            $searchin = $searchDesc['Taskapp']['desc'];
            $tasks = Taskapp::find()->where(['like', 'description', "$searchin"])->orderBy('id DESC')->all();
        } elseif(isset($searchDesc['id']) && intval($searchDesc['id'])<3) {
            $searchin = intval($searchDesc['id']);
            $tasks = Taskapp::find()->where(['status'=>"$searchin"])->orderBy('id DESC')->all();
        } else {
        	$tasks = Taskapp::find()->orderBy('id DESC')->all();
        }


        return $this->render(
            'index',
            compact(
                'tasks','pri','sta','model',
                'tCountAll','tCountNew','tCountProg','tCountFin'
            ));
    }

    public function actionCreate() {
    	$model = new Taskapp();

    	if($model->load(Yii::$app->request->post())) 
        {		
        	var_dump($model->created_at_formatted);
	    	if($model->created_at_formatted){
			    $model->deadline = strtotime($model->created_at_formatted);
			    var_dump($model->deadline);
			}

			if($model->save())
			{	
				return $this->redirect(['index']);
			}
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
            'model' => $model
        ]);
        } else {
            return $this->render('create', [
            'model' => $model
        ]);
        }

    }


    public function actionUpdate($id)
    {	
        $id = Yii::$app->request->get('id');

		$model = $this->findModel($id);
        
        if($model->status == 0) {
            return $this->redirect(['index']);
        }
        if($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            return $this->redirect(['index']);
        } 
        else 
        {
            if(Yii::$app->request->isAjax){

                return $this->renderAjax('update', [
                    'model' => $model,
                ]);

            } else {
                return $this->render('update', [
                'model' => $model,
                ]);
            }
        }
    }


    public function actionDelete($id)
    {
		$this->findModel($id)->delete();
		
		return $this->redirect(['index']);
    }

    public function actionTaskstop($id){
        date_default_timezone_set("Asia/Irkutsk");
        $currentDate = time();
        $task = $this->findModel($id);
        $task->status = '2'; 
        $task->date_end = $currentDate;
        $task->update(false);
        return $this->redirect(['index']); 
    }


    protected function findModel($id)
    {
		if (($model = Taskapp::findOne($id)) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException(Yii::t('messages', 'Эта страница не существует!'));
        }
    }
}