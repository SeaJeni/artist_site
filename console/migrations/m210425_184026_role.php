<?php

use yii\db\Migration;

/**
 * Class m210425_184026_role
 */
class m210425_184026_role extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('role', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
         
        ]);
        $this->batchInsert('role',['name'], [
            ['admin'],
            ['manager'],
            ['main_artist'],
            ['artist'],
            ['waiting'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('role', ['in', 'name', [
            'admin',
            'manager',
            'main_artist',
            'artist',
            'waiting',
        ]]);

        $this->dropTable('role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210425_184026_role cannot be reverted.\n";

        return false;
    }
    */
}
