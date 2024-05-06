<?php

use yii\db\Migration;

/**
 * Class m240423_130809_add_is_admin_to_user_table
 */
class m240423_130809_add_is_admin_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'is_admin', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'is_admin');
    }

  
}
