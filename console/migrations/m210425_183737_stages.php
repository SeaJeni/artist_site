<?php

use yii\db\Migration;

/**
 * Class m210425_183737_stages
 */
class m210425_183737_stages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
$this->createTable('stage', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable('stage');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210425_183737_stages cannot be reverted.\n";

        return false;
    }
    */
}
