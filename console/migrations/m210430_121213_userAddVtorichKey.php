<?php

use yii\db\Migration;

/**
 * Class m210430_121213_userAddVtorichKey
 */
class m210430_121213_userAddVtorichKey extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx-user-role_id',
            'user',
            'role_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user-role_id',
            'user',
            'role_id',
            'role',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         $this->dropForeignKey(
            'fk-user-role_id',
            'user'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-user-role_id',
            'user'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210430_121213_userAddVtorichKey cannot be reverted.\n";

        return false;
    }
    */
}
