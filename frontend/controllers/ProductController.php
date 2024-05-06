<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\Products;
use common\models\Category; 
use yii\web\NotFoundHttpException;   
use yii\filters\VerbFilter;     
use yii\filters\AccessControl;
use common\models\User;
use common\config\main;
use common\web\img;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

  
    

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex()
{
    $categories = Category::find()->all();

    $query = Products::find(); 
    $totalCount = $query->count(); 

    $pagination = new Pagination([
        'defaultPageSize' => 12,
        'totalCount' => $totalCount,
    ]);

    $products = $query->orderBy('name')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

    return $this->render('index', [
        'products' => $products,
        'categories' => $categories,
        'pagination' => $pagination,
    ]);
}


    
    
 
    

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

  

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        $model = Product::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $model;
    }

    public function actionReduceQuantity($id)
    {
        $model = Product::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('The requested product does not exist.');
        }

        if ($model->quantity > 0) {
            $model->quantity -= 1;
            if ($model->validate(['quantity'])) {
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Quantity reduced successfully.');
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to reduce quantity.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Failed to validate product: ' . implode(', ', $model->getFirstErrors()));
            }
        } else {
            Yii::$app->session->setFlash('error', 'Quantity is already one.');
        }

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    


}
