<?php

use yii\db\Migration;

/**
 * Class m210429_112207_term
 */
class m210429_112207_term extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('term', [
            'id' => $this->primaryKey(),
            'stage_id' => $this->integer()->notNull(),
            'project_id' => $this->integer()->notNull(),
            'start_time'=> $this->timestamp()->notNull(),
            'end_time'=> $this->timestamp(),
            
               
           
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('term');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210429_112207_term cannot be reverted.\n";

        return false;
    }
    */
}
