<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email',
            // Add more columns if needed
            
            // ['class' => 'yii\grid\ActionColumn'],
        ],
        'pager' => [
            'options' => ['class' => 'pagination'], // Add Bootstrap pagination class here
            'prevPageLabel' => '&laquo;',
            'nextPageLabel' => '&raquo;',
            'maxButtonCount' => 5, // Adjust the maximum number of page buttons
            'linkContainerOptions' => ['class' => 'page-item'], // Add Bootstrap page-item class here
            'linkOptions' => ['class' => 'page-link'], // Add Bootstrap page-link class here
            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'], // Add Bootstrap page-link class to disabled items
        ],
    ]); ?>
</div>
