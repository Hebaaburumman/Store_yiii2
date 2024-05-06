<?php
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-4">
        <?= $this->render('card', [
            'title' => 'Products',
            'quantity' => $productCount,
            'iconClass' => 'fas fa-fw fa-box',
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('card', [
            'title' => 'Categories',
            'quantity' => $categoryCount,
            'iconClass' => 'fa fa-folder',
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('card', [
            'title' => 'Users',
            'quantity' => $userCount,
            'iconClass' => 'fa fa-users',
        ]) ?>
    </div>
</div>
<?php
echo Highcharts::widget([
    'options' => [
        'chart' => ['type' => 'column'],
        'title' => ['text' => 'Products per Category'],
        'xAxis' => [
            'categories' => array_column($data, 'name'), // Extract category names
        ],
        'yAxis' => [
            'title' => ['text' => 'Number of Products'],
        ],
        'series' => [
            [
                'name' => 'Product Count', // Series name
                'data' => array_column($data, 'product_count'), // Extract product counts
            ]
        ],
    ],
]);


?>



