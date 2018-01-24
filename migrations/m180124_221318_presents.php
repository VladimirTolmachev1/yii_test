<?php

use yii\db\Migration;

/**
 * Class m180124_221318_presents
 */
class m180124_221318_presents extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180124_221318_presents cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('presents', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer()->notNull(),
            'present_name' => $this->string(255)->notNull(),
            'status' => "ENUM('success', 'in_progress', 'error')",
            'update_time' => $this->timestamp()->notNull()
        ]);
    }

    public function down()
    {
        echo "m180124_221318_presents cannot be reverted.\n";

        $this->dropTable('presents');

        return false;
    }

}
