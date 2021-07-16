<?php

use yii\db\Migration;

/**
 * Class m210425_181941_customers
 */
class m210425_181941_customers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
$this->createTable('customer', [
            'id' => $this->primaryKey(),
            'nickname' => $this->string(),
            'first_name' => $this->string(),
            'last_name' => $this->string()->notNull(),
            'email' => $this->string(),
            'country' => $this->string(),
            'url' => $this->string(),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('customer');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210425_181941_customers cannot be reverted.\n";

        return false;
    }
    */
}
