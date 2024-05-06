<?php

use yii\helpers\Html;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;



use frontend\assets\BackendAsset;

    $backend = BackendAsset::register($this);

?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1> 

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card h-100">
                    <div class="row no-gutters">
                    <div class="col-md-4">

    <img src="<?= $backend->baseUrl . '/' . Html::encode($product['image']) ?>" width="100%" height="100">

</div>


                        <div class="col-md-8">
                            <div class="card-body">
                            <?php
$categoriesCount = count($product->categories);
foreach ($product->categories as $index => $category) {
    // Apply grey color style
    echo '<span style="color: grey;">' . Html::encode($category->name) . '</span>';
    
    // Add slash separator if not the last category
    if ($index < $categoriesCount - 1) {
        echo ' / ';
    }
}
?>

<br><br>
                    <h5 class="card-title"><?= Html::encode($product['name']) ?></h5>
                                <p class="card-text"><?= Html::encode($product['description']) ?></p>
                                <p class="card-text">Quantity: <?= Html::encode($product['quantity']) ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <p class="card-text ml-auto">price: <?= Html::encode($product['price']) ?> JD</p>
                                    </div>
                                </div>
                                <?php if ($product->user): ?>
            <p>Created by: <?= Html::encode($product->user->username) ?></p>
        <?php else: ?>
            <p>Created by: Unknown</p>
        <?php endif; ?>
                                <div class="btn-group">
                                    </div>
                                    <p>
                                    <!-- <?= Html::a('Add to Cart', ['/cart/index', 'id' => $product->id], ['class' => 'btn btn-primary']) ?> -->
                                    <?= Html::a('Add to Cart', ['/cart/add', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>

    </p>


   

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


</div>
<?= \yii\bootstrap4\LinkPager::widget(['pagination' => $pagination]) ?>





