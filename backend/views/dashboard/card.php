<?php
use yii\helpers\Html;
?>
<div class="card"style="background-color:#FFB6C1;">
<div class="card-footer" style="background-color:#FFB6C1;">
        <i class="<?= $iconClass ?>"></i>
    </div>
    <div class="card-body">
        <h5 class="card-title"><b><?= Html::encode($title) ?></b></h5>
        <p class="card-text"><h3><?= $quantity ?></h3></p>
    </div>

</div>
<hr class="sidebar-divider">


