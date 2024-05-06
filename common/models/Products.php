<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Category;
use common\models\User;



class Products extends ActiveRecord
{
    public $category_ids; // Add this property

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
       
  
        return [
            [['name', 'description', 'quantity', 'price', 'category_ids'], 'required'], // Include 'category_ids' as required
            [['description'], 'string'],
            [['quantity'], 'integer', 'min' => 0],
            [['price'], 'number', 'min' => 0],
            [['name'], 'string', 'max' => 255],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
            [['category_id'], 'each', 'rule' => ['integer']], // Validate category_ids as an array of integers
            ['user_id', 'exist', 'targetClass' => User::className(), 'targetAttribute' => 'id'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'category_ids' => 'Categories', // Label for the category_ids field
            'user_id' => 'Created By', // Label for the user_id field
        ];
    }

    /**
     * Define a many-to-many relation with Category model
     */
    
    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->viaTable('product_category', ['product_id' => 'id']);
    }
    public function getMilestones()
    {
        return $this->hasMany(products::class, ['id' => 'product_id']);
    }

    /**
     * Calculate the total number of milestones for the product.
     * Adjust this method according to your application's logic.
     */
    public function calculateMilestonesCount()
    {
        return $this->getMilestones()->count();
    }


    public function getUser()
    {
        // Define the relationship: each product belongs to one user
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}



