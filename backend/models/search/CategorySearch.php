<?php

namespace backend\models\search;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;

// class CategorySearch extends Category
// {
//     public function rules()
//     {
//         return [
//             [['id'], 'integer'],
//             [['name'], 'safe'],
//         ];
//     }

//     public function scenarios()
//     {
//         return Model::scenarios();
//     }

//     public function search($params)
//     {
//         $query = Category::find();

//         $dataProvider = new ActiveDataProvider([
//             'query' => $query,
//         ]);

//         $this->load($params);

//         if (!$this->validate()) {
//             return $dataProvider;
//         }

//         $query->andFilterWhere(['like', 'name', $this->name]);

//         return $dataProvider;
//     }
// }




class CategorySearch extends Category
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Category::find()->select(['category.*', 'COUNT(products.id) AS product_count', 'GROUP_CONCAT(products.name) AS product_names'])
            ->joinWith('products')
            ->groupBy('category.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'category.name', $this->name]);

        return $dataProvider;
    }
}
