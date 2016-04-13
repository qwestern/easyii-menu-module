<?php

namespace qwestern\easyii\menu\controllers;

use qwestern\easyii\menu\models\Menu;
use Yii;
use qwestern\easyii\menu\models\MenuItem;
use yii\data\ActiveDataProvider;
use yii\easyii\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ItemController implements the CRUD actions for MenuItem model.
 */
class ItemController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MenuItem models.
     * @return mixed
     */
    public function actionIndex($id)
    {

        $dataProvider = new ActiveDataProvider([
            'query' => MenuItem::find()->where(['menu_id' => $id])->roots(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }

    /**
     * Displays a single MenuItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MenuItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new MenuItem([
            'menu_id' => $id,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if(!$model->parent) {
                $model->makeRoot();
            } else {
                $parent = $this->findModel($model->parent);
                $model->appendTo($parent);
            }

            return $this->redirect(['index', 'id' => $id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MenuItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax) {
            $parentId = Yii::$app->request->post('parent_id');
            if($parentId == $id) {
                return true;
            }elseif ($parentId == null) {
                $model->makeRoot();
                return true;
            }
            $parentItem = MenuItem::findOne($parentId);
            $model->appendTo($parentItem);

            Yii::$app->response->format = Response::FORMAT_JSON;
            return true;
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MenuItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MenuItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MenuItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MenuItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
