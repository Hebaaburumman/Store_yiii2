<?php

namespace frontend\models;
use common\models\Products;
use common\models\User;
use common\models\Category;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $products_id
 * @property int|null $quantity
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Products $products
 * @property User $user
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'products_id', 'quantity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['products_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['products_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'products_id' => 'Products ID',
            'quantity' => 'Quantity',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Products::class, ['id' => 'products_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    
    public static function getCartItems()
    {
        $userId = Yii::$app->user->id; // Assuming you have user authentication
        return static::find()->where(['user_id' => $userId])->all();
    }
}
