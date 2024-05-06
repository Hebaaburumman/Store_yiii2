<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Cart;
use common\models\Products;

class CartController extends Controller
{
    public function actionIndex()
{
    $cartItem = Cart::getCartItems(); // Retrieve cart items from the database

    // Fetch products associated with cart items
    $products = [];
    foreach ($cartItem as $cart) {
        // Assuming 'product' is the relation name to access the associated product
        $products[] = $cart->products; // Change $cartItem->products to $cartItem->product
    }

    return $this->render('index', [
        'products' => $products,
        'cartItems' => $cartItem,
    ]);
}




    public function actionAdd($id)
{
    $product = Products::findOne($id);
    if (!$product) {
        throw new NotFoundHttpException('The requested product does not exist.');
    }

    // Check if the product already exists in the cart for the current user
    $cartItem = Cart::findOne(['products_id' => $product->id, 'user_id' => Yii::$app->user->id]);

    if ($cartItem) {
        // Product already exists in the cart, increment the quantity
        $cartItem->quantity += 1;
    } else {
        // Product does not exist in the cart, add a new entry
        $cartItem = new Cart();
        $cartItem->products_id = $product->id;
        $cartItem->user_id = Yii::$app->user->id; // Assuming you have user authentication
        $cartItem->quantity = 1; // Initial quantity is 1
    }

    // Save the changes to the cart item
    if ($cartItem->save()) {
        Yii::$app->session->setFlash('success', 'Product added to cart successfully.');
    } else {
        Yii::$app->session->setFlash('error', 'Failed to add product to cart.');
    }

    return $this->redirect(['/cart/index']);
}

    


public function actionDelete($id)
{
    // Find the cart item based on the provided $id
    $cartItem = CartItem::findOne($id);

    // Check if the cart item exists
    if ($cartItem !== null) {
        // Delete the cart item
        $cartItem->delete();
    } else {
        // Handle case where the cart item is not found
        Yii::$app->session->setFlash('error', 'The cart item does not exist.');
    }

    // Redirect to the cart index page
    return $this->redirect(['cart/index']);
}



}
