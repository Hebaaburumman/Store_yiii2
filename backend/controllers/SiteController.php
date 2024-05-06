<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use backend\models\User;
use backend\models\LoginForm;
// use backend\models\UserSearch;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }


/**
 * Displays the login page.
 *
 * @return string|\yii\web\Response
 */
public function actionLogin()
{
    // Check if the user is already logged in
    if (!Yii::$app->user->isGuest) {
        return $this->goHome();
    }

    // Instantiate the login form model
    $model = new LoginForm();

    // If the form is submitted
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
        // Check if the user is an admin
        if (Yii::$app->user->identity->is_admin == 1) {
            return $this->redirect(['/dashboard/view/']); // Redirect admin to backend
        } else {
            // Redirect non-admin users back to the login form
            Yii::$app->user->logout();
            Yii::$app->session->setFlash('error', 'You do not have permission to access the admin panel.');
            return $this->refresh();
        }
    }

    // Render the login form
    return $this->render('login', [
        'model' => $model,
    ]);
}



    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    
    

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

//     public function actionAdminOnlyAction()
// {
//     if (!Yii::$app->user->identity->is_admin) {
//         // Display an error message or redirect to a different page
//         throw new ForbiddenHttpException('You are not authorized to perform this action.');
//     }

//     // Proceed with the admin-only action
// }


public function actionRedirect()
{
    // Directly accessing frontend view file using @frontend alias
    return $this->redirect('@frontend/views/product/index');
}
}
