<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Progress;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= Html::encode($this->title) ?></h1>
    <p class="mb-4">Welcome to the dashboard! Here you can view various statistics and project details.</p>

    <!-- Content Row -->
    <div class="row">

        <!-- Chart Pie -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <?= Html::tag('span', Html::tag('i', '', ['class' => 'fas fa-circle text-primary']) . ' Direct', ['class' => 'mr-2']) ?>
                        <?= Html::tag('span', Html::tag('i', '', ['class' => 'fas fa-circle text-success']) . ' Social', ['class' => 'mr-2']) ?>
                        <?= Html::tag('span', Html::tag('i', '', ['class' => 'fas fa-circle text-info']) . ' Referral', ['class' => 'mr-2']) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                    <?= $this->render('_project_progress') ?>
                </div>
            </div>
        </div>

        <!-- Color System -->
        <div class="col-lg-4 mb-4">
            <?= $this->render('_color_system') ?>
        </div>
    </div>
</div>
