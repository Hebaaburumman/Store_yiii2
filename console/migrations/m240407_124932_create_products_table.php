<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m240407_124932_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if (!$this->db->getTableSchema('{{%products}}')) {
            $this->createTable('{{%products}}', [
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull(),
                'description' => $this->text(),
                'quantity' => $this->integer()->defaultValue(1)->check('quantity >= 0'),
                'price' => $this->decimal(10, 2)->notNull()->defaultValue(1.00)->check('price >= 1.00'),
                'image' => $this->string()->defaultValue(null),
                'category_id' => $this->integer(),
            ]);

        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
