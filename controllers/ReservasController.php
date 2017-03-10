<?php

namespace app\controllers;

use Yii;
use app\models\Reserva;
use app\models\Vuelo;
use app\models\ReservaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;


/**
 * ReservasController implements the CRUD actions for Reserva model.
 */
class ReservasController extends Controller
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
            'access'=>['class'=>AccessControl::className(),
            'only'=>['index'],
            'rules'=>[
             [
               'allow'=>true,
               'actions'=>['index'],
               'roles'=>['@'],
               'matchCallback' => function ($rule, $action) {
                      return Yii::$app->user->identity->nombre === 'pepo';
                      // Solo puede entrar el usuaroi pepe
                  }
               ]
          ],
      ],
        ];
    }

    /**
     * Lists all Reserva models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReservaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reserva model.
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
     * Creates a new Reserva model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reserva();
        $model->usuario_id = Yii::$app->user->identity->id;
        $vuel = Vuelo::find()->select('id_vuelo')->asArray()->all();


    if ($model->load(Yii::$app->request->post()) /*&& $model->save('false')*/) {
            $model->usuario_id = Yii::$app->user->identity->id;
            $valor = Vuelo::find()->select('id')->where(['id_vuelo' => $model->vuel])->asArray()->one();
            $model->vuelo_id = $valor['id'];
            $model->save('false');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'vuel' => $vuel,
            ]);
        }
    }

    /**
     * Updates an existing Reserva model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Reserva model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionVuelos($q)
    {
        $dataProvider = new ActiveDataProvider([
            //'query' => Vuelo::find()->where(['ilike', 'id_vuelo', $q]),
            'query' => Vuelo::find()->where("id_vuelo ilike '%$q%'"),
            'pagination' => [
                'pageSize' => 1,
            ],
            'sort' => false,
        ]);
        return $this->renderAjax('_vuelos', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Finds the Reserva model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reserva the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reserva::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
