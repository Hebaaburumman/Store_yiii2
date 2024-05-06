<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;



use frontend\assets\BackendAsset;

    $backend = BackendAsset::register($this);

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1> 

	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

          

<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($cartItems as $cartItem): ?>
                    
<tr>
    <td class="col-sm-8 col-md-6">
        <div class="media">
            <img src="<?= $backend->baseUrl . '/' . $cartItem->products->image ?>" class="thumbnail pull-left" width="72px" height="72px">
            <div class="media-body">
                <h4 class="media-heading"><?= Html::encode($cartItem->products->name) ?></h4>
            </div>
        </div>
    </td>
   
    <td class="col-sm-1 col-md-1" style="text-align: center">
        <?php
        // Display the quantity input field with the quantity from the $cartItem object
        echo Html::input('number', "quantity[{$cartItem->id}]", $cartItem->quantity, ['class' => 'form-control quantity-input', 'min' => 1]);
        ?>
    </td>
    <td class="col-sm-1 col-md-1 original-price" data-price="<?= $cartItem->products->price ?>" style="text-align: center">
        <?= Yii::$app->formatter->asCurrency($cartItem->products->price) ?>
    </td>
    <td class="col-sm-1 col-md-1 total-price" style="text-align: center">
        <?= Yii::$app->formatter->asCurrency($cartItem->products->price * $cartItem->quantity) ?>
    </td>
    <td class="col-sm-1 col-md-1">
        <?= Html::button('<span class="glyphicon glyphicon-remove"></span> Remove', ['class' => 'btn btn-danger remove-product', 'data-id' => $cartItem->id]) ?>
    </td>
</tr>
    


<?php endforeach; ?>
<?php
$totalPrice = 0; // Initialize total price outside the loop

foreach ($cartItems as $cartItem): // Assuming $cartItems is your array of cart items
    $totalPrice += $cartItem->products->price * $cartItem->quantity; // Calculate total price
?>
    <!-- Display other table cells for each cart item -->
<?php endforeach; ?>

<tr>
    <td colspan="4" class="text-right"><h3>Total</h3></td>
    <td class="text-right"><h3><strong><?= Yii::$app->formatter->asCurrency($totalPrice) ?></strong></h3></td>
</tr>

                    <!-- <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                        <button type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </button></td>
                        <td>
                        <button type="button" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        $('.quantity-input').on('change', function(){
            // Get the quantity value
            var quantity = parseInt($(this).val());
            
            // Get the original price value
            var price = parseFloat($(this).closest('tr').find('.original-price').data('price'));
            
            // Calculate the total price by multiplying the quantity with the price
            var totalPrice = quantity * price;
            
            // Update the displayed total price
            $(this).closest('tr').find('.total-price').text(totalPrice.toFixed(2)); // assuming you want to display the price with two decimal places
        });
    });
</script>


