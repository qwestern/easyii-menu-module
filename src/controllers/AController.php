<?php
namespace qwestern\easyii\menu\controllers;

use qwestern\easyii\menu\models\Menu;
use Yii;
use yii\data\ActiveDataProvider;
use yii\easyii\components\Controller;
use yii\web\NotFoundHttpException;

class AController extends Controller
{
    public function actionIndex() {

        $dataProvider = new ActiveDataProvider(['query' => Menu::find()]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate() {
        $model = new Menu();
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'model' => $model
        ]);
    }

    function actionUpdate($id) {
        $model = $this->getModel($id);

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['index']);
        }
        return $this->render('edit', [
            'model' => $model
        ]);
    }

    public function getModel($id) {
        if($item = Menu::findOne($id)) {
            return $item;
        }
        throw new NotFoundHttpException();
    }
}