<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\Pagination;
use common\models\Products;   
use backend\models\search\CategorySearch;
use backend\models\search\ProductSearch;   
use yii\web\NotFoundHttpException;   
use yii\filters\VerbFilter;     
use common\models\Category;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use backend\models\User;
use yii\filters\AccessControl;
/**  
 */   
class ProductController extends Controller   
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
  
    /**  
     * Lists all Employees models.  
     * @return mixed  
     */   
   
    public function actionIndex()
{
    $searchModel = new ProductSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    
    $dataProvider->pagination = [
        'pageSize' => 3, 
    ];

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
}


 
    
    /**  
     * @param integer $id  
     * @return mixed  
     */   
    public function actionView($id)
    {
        // Find the product model by ID
        $model = $this->findModel($id);
        
        return $this->render('view', [
            'model' => $model,
        ]);
    }  
    public function actionCreate()
    {
        $model = new Products();
        $categories = Category::find()->all();
    
        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');
    
            if ($model->validate()) {
                $model->user_id = Yii::$app->user->id; // Set the user_id attribute to the ID of the logged-in user
    
                $imagePath = Yii::getAlias('@webroot/img/');
        
                if ($model->image) {
                    $model->image->saveAs($imagePath . $model->image->baseName . '.' . $model->image->extension);
                }
    
                $model->save(false);
    
                $selectedCategoryIds = Yii::$app->request->post('Products')['category_ids'];
                foreach ($selectedCategoryIds as $selectedCategoryId) {
                    $category = Category::findOne($selectedCategoryId);
                    $model->link('categories', $category);
                }
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    
        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }
    





    /**  
     * Creates a new Employees model.  
     * If creation is successful, the browser will be redirected to the 'view' page.  
     * @return mixed  
     */   
    
// public function actionCreate()
// {
//     $model = new Products();
//     $categories = Category::find()->all();

//     if ($model->load(Yii::$app->request->post())) {
//         $model->image = UploadedFile::getInstance($model, 'image');

//         if ($model->validate()) {

//             $imagePath = Yii::getAlias('@webroot/img/');
    
//             if ($model->image) {
//                 $model->image->saveAs($imagePath . $model->image->baseName . '.' . $model->image->extension);
//             }

//             $model->save(false);

//             $selectedCategoryIds = Yii::$app->request->post('Products')['category_ids'];
//             foreach ($selectedCategoryIds as $selectedCategoryId) {
//                 $category = Category::findOne($selectedCategoryId);
//                 $model->link('categories', $category);
//             }
            
//             return $this->redirect(['view', 'id' => $model->id]);
//         }
//     }

//     return $this->render('create', [
//         'model' => $model,
//         'categories' => $categories,
//     ]);
// }

     
/**   
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
     * Deletes an existing Employees model.  
     * If deletion is successful, the browser will be redirected to the 'index' page.  
     * @param integer $id  
     * @return mixed  
     */   
    public function actionDelete($id)   
    {   
        $this->findModel($id)->delete();   
    return $this->redirect(['index']);   
    }   
  
    // * Finds the Product model based on its primary key value.
    // * If the model is not found, a 404 HTTP exception will be thrown.
    // * @param integer $id
    // * @return Products the loaded model
    // * @throws NotFoundHttpException if the model cannot be found
    // */
   protected function findModel($id)
   {
       // Attempt to find the product model by ID
       $model = Products::findOne($id);
       
       // If the model is not found, throw a 404 HTTP exception
       if ($model === null) {
           throw new NotFoundHttpException('The requested page does not exist.');
       }
       
       return $model;
   }
   
 
    public function actionReduceQuantity($id)
    {
        $model = Products::findOne($id);
        
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

?>