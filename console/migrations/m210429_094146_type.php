<?php

use yii\db\Migration;

/**
 * Class m210429_094146_type
 */
class m210429_094146_type extends Migration
{
    /**
     * {@inheritdoc}
     */
  public function safeUp()
    {
        $this->createTable('type', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('type');
       
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210429_094146_type cannot be reverted.\n";

        return false;
    }
    */
}
