<?php

use yii\db\Migration;

/**
 * Class m210504_075544_add_payment_statys_in_project
 */
class m210504_075544_add_payment_statys_in_project extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $this->addColumn('project', 'payment_status', $this->string(1));
       $this->alterColumn('project', 'payment_status', 'ENUM("0", "1") NOT NULL DEFAULT "0"');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('project', 'payment_status', 'string');
        $this->dropColumn('project', 'payment_status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210504_075544_add_payment_statys_in_project cannot be reverted.\n";

        return false;
    }
    */
}
