<?php

use yii\db\Migration;

/**
 * Class m210429_105513_price_list
 */
class m210429_105513_price_list extends Migration
{
    /**
     * {@inheritdoc}
     */
   public function safeUp()
    {
        $this->createTable('price_list', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'stage_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'price' => $this->double()->notNull(),
         ]);
        
        $this->createIndex(
            'idx-price_list-user_id',
            'price_list',
            'user_id'
        );
        $this->addForeignKey(
            'fk-price_list-user_id',
            'price_list',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        
        
        $this->createIndex(
            'idx-price_list-stage_id',
            'price_list',
            'stage_id'
        );
        $this->addForeignKey(
            'fk-price_list-stage_id',
            'price_list',
            'stage_id',
            'stage',
            'id',
            'CASCADE'
        );
        
        $this->createIndex(
            'idx-price_list-type_id',
            'price_list',
            'type_id'
        );
        $this->addForeignKey(
            'fk-price_list-type_id',
            'price_list',
            'type_id',
            'type',
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
            'fk-price_list-user_id',
            'price_list'
        );
        $this->dropIndex(
            'idx-price_list-user_id',
            'price_list'
        );
        
        $this->dropForeignKey(
            'fk-price_list-stage_id',
            'price_list'
        );
        $this->dropIndex(
            'idx-price_list-stage_id',
            'price_list'
        );
        
        $this->dropForeignKey(
            'fk-price_list-type_id',
            'price_list'
        );
        $this->dropIndex(
            'idx-price_list-type_id',
            'price_list'
        );
        
       $this->dropTable('price_list');
    }
    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210429_105513_price_list cannot be reverted.\n";

        return false;
    }
    */
}
