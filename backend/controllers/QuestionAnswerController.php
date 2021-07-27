<?php

namespace backend\controllers;

use common\models\Question;
use common\models\QuestionAnswer;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * QuestionAnswerController implements the CRUD actions for QuestionAnswer model.
 */
class QuestionAnswerController extends Controller
{

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all QuestionAnswer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => QuestionAnswer::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QuestionAnswer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $question_id=null)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'question' => $this->findQuestionModel($question_id)
        ]);
    }

    /**
     * Creates a new QuestionAnswer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($question_id)
    {
        $model = new QuestionAnswer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['question/view', 'id' => $question_id]);
        }
        return $this->render('create', [
            'model' => $model,
            'question' => $this->findQuestionModel($question_id)
        ]);
    }

    /**
     * Updates an existing QuestionAnswer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $question_id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['question/view', 'id' => $question_id]);
        }
        return $this->render('update', [
            'model' => $model,
            'question' => $this->findQuestionModel($question_id)
        ]);
    }

    /**
     * Deletes an existing QuestionAnswer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $question_id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['question/view', 'id' => $question_id]);
    }

    /**
     * Finds the QuestionAnswer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuestionAnswer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuestionAnswer::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findQuestionModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
