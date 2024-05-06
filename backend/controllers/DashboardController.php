<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use common\models\Products;
use common\models\Category;
use yii\filters\VerbFilter;
use backend\models\User;

class DashboardController extends Controller
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

  
   
    public function actionView()
    {
        $productCount = Products::find()->count();
        $categoryCount = Category::find()->count();
        $userCount = User::find()->count();
    
        $data = Products::find()
            ->select(['category.name', 'COUNT(*) AS product_count'])
            ->joinWith('categories') 
            ->groupBy('category.name')
            ->asArray()
            ->all();
    
        return $this->render('view', [
            'productCount' => $productCount,
            'categoryCount' => $categoryCount,
            'userCount' => $userCount,
            'data' => $data, // Pass the $data variable to the view
        ]);
    }
    
    

    

}
    

