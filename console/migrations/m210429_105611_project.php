<?php

use yii\db\Migration;

/**
 * Class m210429_105611_project
 */
class m210429_105611_project extends Migration
{
    /**
     * {@inheritdoc}
     */
   public function safeUp()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'status'=>$this->boolean()->defaultValue(false),
            'stage_id' => $this->integer()->notNull(),
            'type_id' => $this->integer()->notNull(),
            'manager_id' => $this->integer()->notNull(),
            'main_artist_id' => $this->integer()->notNull(),
            'artist_id' => $this->integer()->notNull(),
            'start_time'=> $this->timestamp()->notNull(),
            'end_time'=> $this->timestamp(),
            'deadline'=> $this->timestamp()->notNull(),
            'cost' => $this->double()->notNull(),
            'customer_id' => $this->integer()->notNull(),
            'payment_status'=> $this->boolean()->defaultValue(false),
        ]);
        
         $this->createIndex(//stage_id
            'idx-project-stage_id',
            'project',
            'stage_id'
        );
        $this->addForeignKey(
            'fk-project-stage_id',
            'project',
            'stage_id',
            'stage',
            'id',
            'CASCADE'
        );
        
        $this->createIndex(//type_id
            'idx-project-type_id',
            'project',
            'type_id'
        );
        $this->addForeignKey(
            'fk-project-type_id',
            'project',
            'type_id',
            'type',
            'id',
            'CASCADE'
        );
        
        $this->createIndex(//manager_id
            'idx-project-manager_id',
            'project',
            'manager_id'
        );
        $this->addForeignKey(
            'fk-project-manager_id',
            'project',
            'manager_id',
            'user',
            'id',
            'CASCADE'
        );
        
         $this->createIndex(//main_artist_id
            'idx-project-main_artist_id',
            'project',
            'main_artist_id'
        );
        $this->addForeignKey(
            'fk-project-main_artist_id',
            'project',
            'main_artist_id',
            'user',
            'id',
            'CASCADE'
        );
        
        
       $this->createIndex(//artist_id
            'idx-project-artist_id',
            'project',
            'artist_id'
        );
        $this->addForeignKey(
            'fk-project-artist_id',
            'project',
            'artist_id',
            'user',
            'id',
            'CASCADE'
        );
        
         $this->createIndex(//customer_id
            'idx-project-customer_id',
            'project',
            'customer_id'
        );
        $this->addForeignKey(
            'fk-project-customer_id',
            'project',
            'customer_id',
            'customer',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         $this->dropForeignKey(//stage_id
            'fk-project-stage_id',
            'project'
        );
        $this->dropIndex(
            'idx-project-stage_id',
            'project'
        );

        $this->dropForeignKey(//type_id
            'fk-project-type_id',
            'project'
        );
        $this->dropIndex(
            'idx-project-type_id',
            'project'
        );

         $this->dropForeignKey(//manager_id
            'fk-project-manager_id',
            'project'
        );
        $this->dropIndex(
            'idx-project-manager_id',
            'project'
        );

         $this->dropForeignKey(//main_artist_id
            'fk-project-main_artist_id',
            'project'
        );
        $this->dropIndex(
            'idx-project-main_artist_id',
            'project'
        );

         $this->dropForeignKey(//artist_id
            'fk-project-artist_id',
            'project'
        );
        $this->dropIndex(
            'idx-project-artist_id',
            'project'
        );

          $this->dropForeignKey(//customer_id
            'fk-project-customer_id',
            'project'
        );
        $this->dropIndex(
            'idx-project-customer_id',
            'project'
        );

        $this->dropTable('project');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210429_105611_project cannot be reverted.\n";

        return false;
    }
    */
}
