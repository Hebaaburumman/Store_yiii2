<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        'description',
        'quantity',
        'price',
        // Assuming 'image' is the attribute storing the image file name
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
    ],
]) ?>


</div>
