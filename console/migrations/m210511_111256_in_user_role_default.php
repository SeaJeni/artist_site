<?php

use yii\db\Migration;

/**
 * Class m210511_111256_in_user_role_default
 */
class m210511_111256_in_user_role_default extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user', 'role_id', 'INTEGER NOT NULL DEFAULT "5"');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('user', 'role_id', 'INTEGER NOT NULL');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210511_111256_in_user_role_default cannot be reverted.\n";

        return false;
    }
    */
}
