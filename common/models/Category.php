<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**

 *
 * @property int $id
 * @property string $name
 */
class Category extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

 

public function getProducts()
{
    return $this->hasMany(Products::class, ['id' => 'product_id'])
        ->viaTable('product_category', ['category_id' => 'id']);
}
}




