<?php

use yii\db\Migration;

/**
 * Class m210425_185453_users
 */
class m210425_185453_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->addColumn('user', 'telegram', $this->string());
       $this->addColumn('user', 'avatar', $this->string());
       $this->addColumn('user', 'role_id', $this->integer()->notNull());
       
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'telegram');
        $this->dropColumn('user', 'avatar');
        $this->dropColumn('user', 'role_id');
        
        
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210425_185453_users cannot be reverted.\n";

        return false;
    }
    */
}
