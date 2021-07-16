<?php

use yii\db\Migration;

/**
 * Class m210429_105927_msg
 */
class m210429_105927_msg extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
       $this->createTable('msg', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'project_id' => $this->integer()->notNull(),
            'msg' => $this->string(),
            'date' => $this->timestamp()->notNull(),
               
           
        ]);
       
        $this->createIndex(
            'idx-msg-user_id',
            'msg',
            'user_id'
        );
        $this->addForeignKey(
            'fk-msg-user_id',
            'msg',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        
        
         $this->createIndex(
            'idx-msg-project_id',
            'msg',
            'project_id'
        );
        $this->addForeignKey(
            'fk-msg-project_id',
            'msg',
            'project_id',
            'project',
            'id',
            'CASCADE'
        );
        
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         $this->dropForeignKey(
            'fk-msg-user_id',
            'msg'
        );
        $this->dropIndex(
            'idx-msg-user_id',
            'msg'
        );
        
        
        $this->dropForeignKey(
            'fk-msg-project_id',
            'msg'
        );
        $this->dropIndex(
            'idx-msg-project_id',
            'msg'
        );
        
        
        
         $this->dropTable('msg');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210429_105927_msg cannot be reverted.\n";

        return false;
    }
    */
}
