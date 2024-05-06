<?php



use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_category}}`.
 */
class m240417_113222_create_product_category_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%product_category}}', [
            'product_id' => $this->integer(),
            'category_id' => $this->integer(),
        ]);

        // Add foreign key constraint for 'product_id' column
        $this->addForeignKey('fk-product_category-product_id', '{{%product_category}}', 'product_id', '{{%products}}', 'id', 'CASCADE', 'CASCADE');
        
        // Add foreign key constraint for 'category_id' column
        $this->addForeignKey('fk-product_category-category_id', '{{%product_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%product_category}}');
    }
}
