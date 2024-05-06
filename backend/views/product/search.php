<?php   
  
use yii\helpers\Html;   
use yii\widgets\ActiveForm;   
  
/* @var $this yii\web\View */   
/* @var $model frontend\models\EmployeesSearch */   
/* @var $form yii\widgets\ActiveForm */   
?>   
  
<div class="employees-search">   
  
    <?php $form = ActiveForm::begin([   
        'action' => ['index'],   
       'method' => 'get',   
    ]); ?>   
  
    <?= $form->field($model, 'id') ?>   
  
    <?= $form->field($model, 'name') ?>   
  
    <?= $form->field($model, 'designation') ?>   
  
    <?= $form->field($model, 'contact') ?>   
  
    <?= $form->field($model, 'email') ?>   
  
    <div class="form-group">   
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>   
       <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>   
    </div>   
  
    <?php ActiveForm::end(); ?>   
  
</div>   