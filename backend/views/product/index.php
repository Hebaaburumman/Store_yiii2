<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            
            [
                'attribute' => 'quantity',
                'format' => 'raw',
                'value' => function ($model) {
                    // Return the quantity and a button with the reduce-quantity-btn class
                    return $model->quantity . ' ' . Html::a(
                        Html::img('@web/img/remove.png', ['alt' => 'Reduce Quantity', 'width' => '20', 'height' => '20']),
                        ['product/reduce-quantity', 'id' => $model->id],
                        [
                            'class' => 'btn btn-default reduce-quantity-btn',
                            'data' => [
                                'confirm' => 'Are you sure you want to reduce the quantity?',
                                'method' => 'post',
                            ],
                        ]
                    );
                }
            ],
            
            'price',
           
            
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($model) {
                    // Adjust the path according to your file structure
                    return Html::img(Yii::getAlias('@web/img/') . $model->image, ['alt' => 'Image', 'width' => '100']);
                },
            ],
            [
                'label' => 'Categories',
                'value' => function ($model) {
                    $categories = $model->categories;
                    $categoryNames = [];
                    foreach ($categories as $category) {
                        $categoryNames[] = $category->name;
                    }
                    return implode(', ', $categoryNames);
                },
            ],
            [
                'attribute' => 'created_by',
                'value' => function ($model) {
                    return $model->user->username;
                },
            ],
            
            

            ['class' => 'yii\grid\ActionColumn'],
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

